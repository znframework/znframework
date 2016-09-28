<?php namespace ZN\Autoloader;

use Converter;
use ZN\Core\Config;

class Autoloader
{
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------
    // Protected Static Classes
    //--------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------
    protected static $classes;

    //--------------------------------------------------------------------------------------------------
    // Protected Static Namespaces
    //--------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------
    protected static $namespaces;

    //--------------------------------------------------------------------------------------------------
    // Run
    //--------------------------------------------------------------------------------------------------
    //
    // @param  autoloader $class
    // @return void
    //
    //--------------------------------------------------------------------------------------------------
    public static function run(String $class)
    {
        $path = CONFIG_DIR.'ClassMap.php';

        if( ! is_file($path) )
        {
            self::createClassMap();
        }

        $classInfo = self::getClassFileInfo($class);
        $file      = self::_originPath(REAL_BASE_DIR.$classInfo['path']);

        if( is_file($file) )
        {
            require_once $file;

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
            self::tryAgainCreateClassMap($class);
        }

        clearstatcache();
    }

    //--------------------------------------------------------------------------------------------------
    // Restart
    //--------------------------------------------------------------------------------------------------
    //
    // ClassMap'i yeniden oluşturmak için kullanılır.
    //
    // @param  void
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    public static function restart()
    {
        $path = CONFIG_DIR.'ClassMap.php';

        if( is_file($path) )
        {
            unlink($path);
            clearstatcache();
        }

        return self::createClassMap();
    }

    //--------------------------------------------------------------------------------------------------
    // Create Class Map
    //--------------------------------------------------------------------------------------------------
    //
    // Config/Autoloader.php dosyasında belirtilen dizinlere ait sınıfların.
    // yol bilgisi oluşturulur. Böylece bir sınıf dahil edilmeden kullanılabilir.
    //
    // @param  void
    // @return void
    //
    //--------------------------------------------------------------------------------------------------
    public static function createClassMap()
    {
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

        $path = CONFIG_DIR.'ClassMap.php';

        if( ! is_file($path) )
        {
            $classMapPage  = '<?php'.$eol;
            $classMapPage .= '//--------------------------------------------------------------------------------------------------'.$eol;
            $classMapPage .= '// This file automatically created and updated'.$eol;
            $classMapPage .= '//--------------------------------------------------------------------------------------------------'.$eol;
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

        file_put_contents($path, $classMapPage, FILE_APPEND);
    }

    //--------------------------------------------------------------------------------------------------
    // Get Class File Info
    //--------------------------------------------------------------------------------------------------
    //
    // Çağrılan sınıfın sınıf, yol ve namespace bilgilerini almak için oluşturulmuştur.
    //
    // @param  string $class
    // @return array
    //
    //--------------------------------------------------------------------------------------------------
    public static function getClassFileInfo(String $class) : Array
    {
        $classCaseLower = strtolower($class);
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

    //--------------------------------------------------------------------------------------------------
    // Token Class File Info
    //--------------------------------------------------------------------------------------------------
    //
    // Yolu belirtilen sınıfın sınıf ve namespace bilgilerini almak için oluşturulmuştur.
    //
    // @param  string $fileName
    // @return array
    //
    //--------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------
    // Token File Info
    //--------------------------------------------------------------------------------------------------
    //
    // Yolu belirtilen fonksiyon bilgilerini almak için oluşturulmuştur.
    //
    // @param  string $fileName
    // @return array
    //
    //--------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------
    // Protected Search Class Map
    //--------------------------------------------------------------------------------------------------
    //
    // Yolu belirtilen Config/Autoloader.php dosyasında belirtilen dizinlere ait sınıfların.
    // yol bilgisi oluşturulur. createClassMap() yöntemi için oluşturulmuştur.
    //
    // @param  string $directory
    // @param  string $baseDirectory
    // @return void
    //
    //--------------------------------------------------------------------------------------------------
    protected static function searchClassMap($directory, $baseDirectory = NULL)
    {
        static $classes;

        $directory           = suffix($directory, DS);
        $baseDirectory       = suffix($baseDirectory, DS);
        $configClassMap      = self::_config();
        $configAutoloader    = Config::get('Autoloader');
        $directoryPermission = $configAutoloader['directoryPermission'];

        $files = glob($directory.'*');
        $files = array_diff
        (
            $files,
            isset($configClassMap['classes']) ? $configClassMap['classes'] : []
        );

        $staticAccessDirectory = self::_relativePath(RESOURCES_DIR.'Statics/');

        $eol = EOL;

        if( ! empty($files) ) foreach( $files as $v )
        {
            $v = self::_relativePath($v);

            if( is_file($v) )
            {
                $classInfo = self::tokenClassFileInfo($v);

                if( isset($classInfo['class']) )
                {
                    $class = strtolower($classInfo['class']);

                    if( isset($classInfo['namespace']) )
                    {
                        $className = strtolower($classInfo['namespace']).'\\'.$class;

                        $classes['namespaces'][$className] = $class;
                    }
                    else
                    {
                        $className = $class;
                    }

                    $classes['classes'][$className] = $v;

                    $useStaticAccess = strtolower(INTERNAL_ACCESS);

                    if
                    (
                        strpos($class, $useStaticAccess) === 0  &&
                        ! preg_match('/(Interface|Trait)$/i', $class)
                    )
                    {
                        $newClassName = str_ireplace($useStaticAccess, '', $classInfo['class']);

                        $newPath = str_ireplace($baseDirectory, '', $v);

                        $pathEx = explode(DS, $newPath);
                        array_pop($pathEx);
                        $newDir = implode(DS, $pathEx);
                        $dir    = $staticAccessDirectory;
                        $newDir = $dir.$newDir;

                        if( ! is_dir($dir) )
                        {
                            mkdir($dir, $directoryPermission, true);
                        }

                        if( ! is_dir($newDir) )
                        {
                            mkdir($newDir, $directoryPermission, true);
                        }

                        $path              = suffix($newDir, DS).$classInfo['class'].'.php';
                        $path              = self::_relativePath($path);
                        $constants         = self::_findConstants($v);
                        $classContent      = self::_classFileContent($newClassName, $constants);
                        $fileContentLength = is_file($path) ? strlen(file_get_contents($path)) : 0;

                        if( strlen($classContent) !== $fileContentLength )
                        {
                            file_put_contents($path, $classContent);
                        }

                        $classes['classes'][strtolower($newClassName)] = $path;
                    }
                }
            }
            elseif( is_dir($v) )
            {
                self::searchClassMap($v, $baseDirectory);
            }
        }

        return $classes;
    }

    //--------------------------------------------------------------------------------------------------
    // Protected Find Constants
    //--------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------
    // Protected Class File Content
    //--------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------
    protected static function _classFileContent($newClassName, $constants)
    {
        $classContent  = '<?php'.EOL;
        $classContent .= '//--------------------------------------------------------------------------------------------------'.EOL;
        $classContent .= '// This file automatically created and updated'.EOL;
        $classContent .= '//--------------------------------------------------------------------------------------------------'.EOL.EOL;
        $classContent .= 'class '.$newClassName.' extends StaticAccess'.EOL;
        $classContent .= '{'.EOL;
        $classContent .= $constants;
        $classContent .= HT.'public static function getClassName()'.EOL;
        $classContent .= HT.'{'.EOL;
        $classContent .= HT.HT.'return __CLASS__;'.EOL;
        $classContent .= HT.'}'.EOL;
        $classContent .= '}'.EOL.EOL;
        $classContent .= '//--------------------------------------------------------------------------------------------------';

        return $classContent;
    }

    //--------------------------------------------------------------------------------------------------
    // Private Config
    //--------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------
    private static function _config()
    {
        $path = CONFIG_DIR.'ClassMap.php';

        if( is_file($path) )
        {
            global $classMap;

            require_once $path;

            return $classMap;
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------
    // Protected Static Try Again Create Class Map
    //--------------------------------------------------------------------------------------------------
    //
    // @param  string $class
    // @return void
    //
    //--------------------------------------------------------------------------------------------------
    protected static function tryAgainCreateClassMap($class)
    {
        self::createClassMap();

        $classInfo = self::getClassFileInfo($class);

        $file = self::_originPath(REAL_BASE_DIR.$classInfo['path']);

        if( is_file($file) )
        {
            require_once $file;
        }
        else
        {
            $backtrace = debug_backtrace(2);
            $debug     = $backtrace[2];
            $message   = 'Error: ['.$class.'] class was not found! Make sure the [class name] is spelled correctly or
                         try to rebuild with [Autoloader::restart()]<br>';
            $message  .= 'File: '.($debug['file'] ?? $backtrace[5]['file'] ?? NULL).'<br>';
            $message  .= 'Line: '.($debug['line'] ?? $backtrace[5]['line'] ?? NULL);

            trace($message);
        }
    }

    //--------------------------------------------------------------------------------------------------
    // Protected Directory Separator
    //--------------------------------------------------------------------------------------------------
    //
    // @param  string $string
    // @return string
    //
    //--------------------------------------------------------------------------------------------------
    protected static function _relativePath($string)
    {
        return str_replace(REAL_BASE_DIR, NULL, self::_originPath($string));
    }

    //--------------------------------------------------------------------------------------------------
    // Protected Origin Path
    //--------------------------------------------------------------------------------------------------
    //
    // @param  string $string
    // @return string
    //
    //--------------------------------------------------------------------------------------------------
    protected static function _originPath($string)
    {
        return str_replace(['/', '\\'], DS, $string);
    }
}

//------------------------------------------------------------------------------------------------------
// Class Alias
//------------------------------------------------------------------------------------------------------
//
// ZN\Autoloader\Autoloader -> Autoloader
//
//------------------------------------------------------------------------------------------------------
class_alias('ZN\Autoloader\Autoloader', 'Autoloader');

//------------------------------------------------------------------------------------------------------
// Autoload Register
//------------------------------------------------------------------------------------------------------
//
// Nesne çağrımında otomatik devreye girerek sınıfın yüklenmesini sağlar.
//
//------------------------------------------------------------------------------------------------------
spl_autoload_register('Autoloader::run');
