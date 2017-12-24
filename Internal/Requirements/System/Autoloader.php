<?php namespace ZN\Classes;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Helpers\Converter;

class Autoloader
{
    /**
     * Keep classes
     * 
     * @var array
     */
    protected static $classes;

    /**
     * Keep namespaces
     * 
     * @var array
     */
    protected static $namespaces;

    /**
     * Keep classmap path
     * 
     * @var string
     */
    protected static $path = CONFIG_DIR . 'ClassMap.php';

    /**
     * This is for cases where the encoding type is not utf-8.
     * 
     * @param string $string = NULL
     * 
     * @return string
     */
    public static function lower(String $string = NULL) : String
    {
        return str_replace('I', 'i', strtolower($string));
    }

    /**
     * This is for cases where the encoding type is not utf-8.
     * 
     * @param string $string = NULL
     * 
     * @return string
     */
    public static function upper(String $string = NULL) : String
    {
        return str_replace('i', 'I', strtoupper($string));
    }

    /**
     * Starts the class load process.
     * 
     * @param string $class
     * 
     * @return void
     */
    public static function run(String $class)
    {
        if( ! is_file(self::$path) )
        {
            self::createClassMap();
        }

        $classInfo = self::getClassFileInfo($class);
        $file      = $classInfo['path'];
        
        if( is_file($file) )
        {
            import($file);

            if
            (
                ! class_exists($classInfo['namespace']) &&
                ! trait_exists($classInfo['namespace']) &&
                ! interface_exists($classInfo['namespace'])
            )
            {
                self::tryAgainCreateClassMap($class);
            }
        }
        else
        {
            // 5.4.2[added]
            if( PROJECT_TYPE === 'EIP' && strpos($file, 'Projects/' . CURRENT_PROJECT) !== 0 )
            {
                self::restart();
            }

            self::tryAgainCreateClassMap($class);
        }
    }

    /**
     * Restarts the class mapping process.
     * 
     * @param void
     * 
     * @return void
     */
    public static function restart()
    {
        if( is_file(self::$path) )
        {
            unlink(self::$path);
        }

        return self::createClassMap();
    }

    /**
     * Starts the class mapping process.
     * 
     * @param void
     * 
     * @return void
     */
    public static function createClassMap()
    {
        clearstatcache();

        import(REQUIREMENTS_DIR . 'Config.php');

        $configAutoloader = Config::get('Autoloader');
        $configClassMap   = self::_config();

        if( $configAutoloader['directoryScanning'] === false )
        {
            return false;
        }

        $classMap = $configAutoloader['classMap'];
       
        if( ! empty($classMap) ) foreach( $classMap as $directory )
        {
            $classMaps = self::searchClassMap($directory, $directory);
        }

        $classArray = array_diff_key
        (
            $classMaps['classes']      ?? [],
            $configClassMap['classes'] ?? []
        );

        $eol  = EOL;

        if( ! is_file(self::$path) )
        {
            $classMapPage  = '<?php'.$eol;
            $classMapPage .= '//----------------------------------------------------------------------'.$eol;
            $classMapPage .= '// This file automatically created and updated'.$eol;
            $classMapPage .= '//----------------------------------------------------------------------'.$eol;
        }
        else
        {
            $classMapPage = '';
        }

        if( ! empty($classArray) )
        {
            self::$classes = $classMaps['classes'];

            foreach( $classArray as $k => $v )
            {
                $classMapPage .= '$classMap[\'classes\'][\''.$k.'\'] = \''.$v.'\';'.$eol;
            }
        }

        $namespaceArray = array_diff_key
        (
            $classMaps['namespaces']      ?? [],
            $configClassMap['namespaces'] ?? []
        );

        if( ! empty($namespaceArray) )
        {
            self::$namespaces = $classMaps['namespaces'];

            foreach( $namespaceArray as $k => $v )
            {
                $classMapPage .= '$classMap[\'namespaces\'][\''.$k.'\'] = \''.$v.'\';'.$eol;
            }
        }

        internalIsWritable(self::$path);

        file_put_contents(self::$path, $classMapPage, FILE_APPEND);
    }

    /**
     * The invoked class holds the class, path, and namespace information.
     * 
     * @param string $class
     * 
     * @return array
     */
    public static function getClassFileInfo(String $class) : Array
    {
        $classCaseLower = self::lower($class);
        $classMap       = self::_config();
        $classes        = array_merge($classMap['classes']    ?? [], (array) self::$classes);
        $namespaces     = array_merge($classMap['namespaces'] ?? [], (array) self::$namespaces);
        $path           = '';
        $namespace      = '';

        if( isset($classes[$classCaseLower]) )
        {
            $path      = $classes[$classCaseLower];
            $namespace = $class;
        }
        elseif( ! empty($namespaces) )
        {
            $namespaces = array_flip($namespaces);

            if( isset($namespaces[$classCaseLower]) )
            {
                $namespace = $namespaces[$classCaseLower];
                $path      = $classes[$namespace] ?? '';
            }
        }

        return
        [
            'path'      => $path,
            'class'     => $class,
            'namespace' => $namespace
        ];
    }

    /**
     * The path holds the class and namespace information of the specified class.
     * 
     * @param string $fileName
     * 
     * @return array
     */
    public static function tokenClassFileInfo(String $fileName) : Array
    {
        $classInfo = [];

        if( ! is_file($fileName) )
        {
            return $classInfo;
        }

        $tokens = token_get_all(file_get_contents($fileName));
        $i      = 0;
        $ns     = '';

        foreach( $tokens as $token )
        {
            if( $token[0] === T_NAMESPACE )
            {
                if( isset($tokens[$i + 2][1]) )
                {
                    if( ! isset($tokens[$i + 3][1]) )
                    {
                        $ns = $tokens[$i + 2][1];
                    }
                    else
                    {
                        $ii = $i;

                        while( isset($tokens[$ii + 2][1]) )
                        {
                            $ns .= $tokens[$ii + 2][1];

                            $ii++;
                        }
                    }
                }

                $classInfo['namespace'] = trim($ns);
            }

            if
            (
                $token[0] === T_CLASS     ||
                $token[0] === T_INTERFACE ||
                $token[0] === T_TRAIT
            )
            {
                $classInfo['class'] = $tokens[$i + 2][1] ?? NULL;

                break;
            }

            $i++;
        }

        return $classInfo;
    }

    /**
     * The location captures information from the specified file.
     * 
     * @param string $fileName
     * @param int    $type = T_FUNCTION
     * 
     * @return mixed
     */
    public static function tokenFileInfo(String $fileName, Int $type = T_FUNCTION)
    {
        if( ! is_file($fileName) )
        {
            return false;
        }

        $tokens = token_get_all(file_get_contents($fileName));
        $info   = [];

        $i = 0;

        $type = Converter::toConstant($type, 'T_');

        foreach( $tokens as $token )
        {
            if( $token[0] === $type )
            {
                $info[] = $tokens[$i + 2][1] ?? NULL;
            }

            $i++;
        }

        return $info;
    }

    /**
     * Search the invoked class in the classmap.
     * 
     * @param string $directory
     * @param string $baseDirectory = NULL
     * 
     * @return mixed
     */
    protected static function searchClassMap($directory, $baseDirectory = NULL)
    {
        static $classes;

        $directory           = suffix($directory);
        $baseDirectory       = suffix($baseDirectory);
        $configClassMap      = self::_config();
        $configAutoloader    = Config::get('Autoloader');
        $directoryPermission = $configAutoloader['directoryPermission'];

        $files = glob($directory.'*');
        $files = array_diff
        (
            $files,
            $configClassMap['classes'] ?? []
        );

        $staticAccessDirectory = RESOURCES_DIR . 'Statics/';

        $eol = EOL;

        if( ! empty($files) ) foreach( $files as $val )
        {
            $v = $val;

            if( is_file($val) )
            {
                $classInfo = self::tokenClassFileInfo($val);

                if( isset($classInfo['class']) )
                {
                    $class = self::lower($classInfo['class']);

                    if( isset($classInfo['namespace']) )
                    {
                        $className = self::lower($classInfo['namespace']).'\\'.$class;

                        $classes['namespaces'][self::_cleanNail($className)] = self::_cleanNail($class);
                    }
                    else
                    {
                        $className = $class;
                    }

                    $classes['classes'][self::_cleanNail($className)] = self::_cleanNail($v);

                    $useStaticAccess = self::lower(INTERNAL_ACCESS);

                    if( strpos($class, $useStaticAccess) === 0  && ! preg_match('/(Interface|Trait)$/i', $class) )
                    {
                        $newClassName = str_ireplace(INTERNAL_ACCESS, '', $classInfo['class']);

                        $pathEx = explode('/', $v);

                        array_pop($pathEx);

                        $newDir = implode('/', $pathEx);
                        $dir    = $staticAccessDirectory;
                        $newDir = $dir.$newDir;
                     
                        if( ! is_dir($dir) )
                        {
                            mkdir($dir, $directoryPermission, true);
                            file_put_contents($dir . '.htaccess', 'Deny from all');
                        }

                        if( ! is_dir($newDir) )
                        {
                            mkdir($newDir, $directoryPermission, true);
                        }

                        $rpath = $path     = suffix($newDir).$classInfo['class'].'.php';
                    
                        $constants         = self::_findConstants($val);
                        $classContent      = self::_classFileContent($newClassName, $constants);
                        $fileContentLength = is_file($rpath) ? strlen(file_get_contents($rpath)) : 0;

                        if( strlen($classContent) !== $fileContentLength )
                        {
                            file_put_contents($rpath, $classContent);
                        }

                        $classes['classes'][self::lower($newClassName)] = $path;
                    }
                }
            }
            elseif( is_dir($val) )
            {
                self::searchClassMap($val, $baseDirectory);
            }
        }

        return $classes;
    }

    /**
     * It finds constants in the class.
     * 
     * @param string $v
     * 
     * @return string
     */
    protected static function _findConstants($v)
    {
        $getFileContent = file_get_contents($v);

        preg_match_all('/const\s+(\w+)\s+\=\s+(.*?);/i', $getFileContent, $match);

        $const = $match[1] ?? [];
        $value = $match[2] ?? [];

        $constants = '';

        if( ! empty($const) )
        {
            foreach( $const as $key => $c )
            {
                $constants .= HT."const ".$c.' = '.$value[$key].';'.EOL.EOL;
            }
        }

        return $constants;
    }

    /**
     * Creates internal class content.
     * 
     * @param string $newClassName
     * @param string $constants
     * 
     * @return string
     */
    protected static function _classFileContent($newClassName, $constants)
    {
        $classContent  = '<?php'.EOL;
        $classContent .= '//-------------------------------------------------------------------------'.EOL;
        $classContent .= '// This file automatically created and updated'.EOL;
        $classContent .= '//-------------------------------------------------------------------------'.EOL.EOL;
        $classContent .= 'class '.$newClassName.' extends StaticAccess'.EOL;
        $classContent .= '{'.EOL;
        $classContent .= $constants;
        $classContent .= HT.'public static function getClassName()'.EOL;
        $classContent .= HT.'{'.EOL;
        $classContent .= HT.HT.'return __CLASS__;'.EOL;
        $classContent .= HT.'}'.EOL;
        $classContent .= '}'.EOL.EOL;
        $classContent .= '//-------------------------------------------------------------------------';

        return $classContent;
    }

    /**
     * Get config
     * 
     * @param void
     * 
     * @return mixed
     */
    private static function _config()
    {
        if( is_file(self::$path) )
        {
            global $classMap;
            
            // 5.4.61[added]
            try
            {
                require_once self::$path;
            }
            catch( \Throwable $e )
            {
                self::restart();
            }

            return $classMap;
        }

        return false;
    }

    /**
     * It attempts to construct the class map.
     * 
     * @param string $class
     * 
     * @return void
     */
    protected static function tryAgainCreateClassMap($class)
    {
        self::createClassMap();

        $classInfo = self::getClassFileInfo($class);

        $file = $classInfo['path'];

        if( is_file($file) )
        {
            import($file);
        }
    }

    /**
     * Clean nail
     * 
     * @param string
     * 
     * @return string
     */
    protected static function _cleanNail($string)
    {
        return str_replace(["'", '"'], NULL, $string);
    }
}

# Alias Autoloader
class_alias('ZN\Classes\Autoloader', 'Autoloader');

/*
|--------------------------------------------------------------------------
| Autoload Register
|--------------------------------------------------------------------------
|
| Enables class loading by automatically activating the object call.
|
*/

spl_autoload_register('Autoloader::run');
