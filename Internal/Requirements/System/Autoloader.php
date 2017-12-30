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

require REQUIREMENTS_DIR . 'Functions.php';

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

        self::isWritable(self::$path);

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

    /**
     * Defines required constants
     * 
     * @param string $version
     * 
     * @return void
     */
    public function defines(String $version, String $dedicate = NULL)
    {
        define('ZN_VERSION', $version);
        define('ZN_DEDICATE', $dedicate);
        define('REQUIRED_PHP_VERSION', '7.0.0');
        define('DS', DIRECTORY_SEPARATOR);
        define('DIRECTORY_INDEX', 'zeroneed.php');
        define('BASE_DIR', ltrim(explode(DIRECTORY_INDEX, $_SERVER['SCRIPT_NAME'])[0], '/'));
        define('PROJECT_CONTROLLER_NAMESPACE', 'Project\Controllers\\');
        define('PROJECT_COMMANDS_NAMESPACE', 'Project\Commands\\');
        define('EXTERNAL_COMMANDS_NAMESPACE', 'External\Commands\\');
        define('INTERNAL_ACCESS', 'Internal');
        define('PROJECTS_DIR', 'Projects/');
        define('EXTERNAL_DIR', (PROJECT_TYPE === 'SE' ? '' : 'External/'));
        define('SETTINGS_DIR', (PROJECT_TYPE === 'SE' ? 'Config' : 'Settings').'/');
        define('PROJECTS_CONFIG', import((is_file(PROJECTS_DIR . 'Projects.php') ? PROJECTS_DIR : SETTINGS_DIR) . 'Projects.php'));
        define('DEFAULT_PROJECT', PROJECTS_CONFIG['directory']['default']);
        define('SSL_STATUS', (server('https') === 'on' ? 'https' : 'http') . '://');
        define('EOL', PHP_EOL);
        define('CRLF', "\r\n" );
        define('CR', "\r");
        define('LF', "\n");
        define('HT', "\t");
        define('TAB', "\t");
        define('FF', "\f");
       
        self::defineContainerDirectoryConstants();
    }

    /**
     * Defines container directory constants
     * 
     * @param void
     * 
     * @return void
     */
    protected static function defineContainerDirectoryConstants()
    {
        self::defineCurrentProject();
        
        define('CONTROLLERS_DIR' , PROJECT_DIR.'Controllers/');
        define('VIEWS_DIR', PROJECT_DIR.'Views/');
        define('PAGES_DIR', VIEWS_DIR); 
        define('CONTAINER_DIRS', 
        [
            'ROUTES_DIR'    => 'Routes'   , 'DATABASES_DIR' => 'Databases'          ,
            'CONFIG_DIR'    => 'Config'   , 'STORAGE_DIR'   => 'Storage'            ,
            'COMMANDS_DIR'  => 'Commands' , 'LANGUAGES_DIR' => 'Languages'          ,
            'LIBRARIES_DIR' => 'Libraries', 'MODELS_DIR'    => 'Models'             ,
            'STARTING_DIR'  => 'Starting' , 'AUTOLOAD_DIR'  => 'Starting/Autoload'  ,
                                            'HANDLOAD_DIR'  => 'Starting/Handload'  ,
                                            'LAYERS_DIR'    => 'Starting/Layers'    ,
            'RESOURCES_DIR' => 'Resources', 'PROCESSOR_DIR' => 'Resources/Processor',
                                            'FILES_DIR'     => 'Resources/Files'    ,
                                            'FONTS_DIR'     => 'Resources/Fonts'    ,
                                            'SCRIPTS_DIR'   => 'Resources/Scripts'  ,
                                            'STYLES_DIR'    => 'Resources/Styles'   ,
                                            'TEMPLATES_DIR' => 'Resources/Templates',
                                            'THEMES_DIR'    => 'Resources/Themes'   ,
                                            'PLUGINS_DIR'   => 'Resources/Plugins'  ,
                                            'UPLOADS_DIR'   => 'Resources/Uploads'
        ]);

        foreach( CONTAINER_DIRS as $key => $value )
        {
            $value .= '/';

            define('EXTERNAL_' . $key, EXTERNAL_DIR . $value);

            if( PROJECT_TYPE === 'EIP' ) # For EIP edition
            {
                define($key, self::getProjectContainerDir($value));
            }
            else # For SE edition
            {
                define($key, $value);
            }
        }
    }

    /**
     * Get project container directory
     * 
     * Returns the project directory name according to the project in the system.
     * Only for multi edition.
     * 
     * @param string $path = NULL
     * 
     * @return string
     */
    protected static function getProjectContainerDir($path = NULL) : String
    {
        $containers          = PROJECTS_CONFIG['containers'];
        $containerProjectDir = PROJECT_DIR . $path;

        if( ! empty($containers) && defined('_CURRENT_PROJECT') )
        {
            $restoreFix = 'Restore';

            # 5.3.8[added]
            if( strpos(_CURRENT_PROJECT, $restoreFix) === 0 && is_dir(PROJECTS_DIR . ($restoredir = ltrim(_CURRENT_PROJECT, $restoreFix))) )
            {
                $condir = $restoredir;

                if( $containers[$condir] ?? NULL )
                {
                    $condir = $containers[$condir];
                }
            }
            else
            {
                $condir = $containers[_CURRENT_PROJECT] ?? NULL;
            }  
            
            return ! empty($condir) && ! file_exists($containerProjectDir)
                    ? PROJECTS_DIR . suffix($condir) . $path
                    : $containerProjectDir;
        }

        # 5.3.33[edited]
        if( is_dir($containerProjectDir) )
        {
            return $containerProjectDir;
        }

        # 5.1.5[added]
        # The enclosures can be the opening controller
        if( $container = ($containers[CURRENT_PROJECT] ?? NULL) )
        {
            $containerProjectDir = str_replace(CURRENT_PROJECT, $container, $containerProjectDir);
        }

        return $containerProjectDir;
    }

    /**
     * Define current project
     * 
     * It arranges some values according to the project which is valid in the system.
     * 
     * @param void
     * 
     * @return mixed
     */
    protected static function defineCurrentProject()
    {
        self::isWritable('.htaccess');

        if( PROJECT_TYPE === 'SE' )
        {
            define('CURRENT_PROJECT', NULL);
            define('PROJECT_DIR'    , NULL);

            return false;
        }

        $projectConfig = PROJECTS_CONFIG['directory']['others'];
        $projectDir    = $projectConfig;

        if( defined('CONSOLE_PROJECT_NAME') )
        {
            $internalDir = CONSOLE_PROJECT_NAME;
        }
        else
        {
            $currentPath = server('currentPath');

            # 5.0.3[edited]
            # QUERY_STRING & REQUEST URI Empty Control
            if( empty($currentPath) && ($requestUri = server('requestUri')) !== '/' )
            {
                $currentPath = $requestUri;
            }
            
            $internalDir = ( ! empty($currentPath) ? explode('/', ltrim($currentPath, BASE_DIR ?: '/'))[0] : '' );
        }

        if( is_array($projectDir) )
        {
            $internalDir = $projectDir[$internalDir] ?? $internalDir;
            $projectDir  = $projectDir[host()] ?? DEFAULT_PROJECT;
        }

        if( ! empty($internalDir) && is_dir(PROJECTS_DIR . $internalDir) )
        {
            define('_CURRENT_PROJECT', $internalDir);

            $flip              = array_flip($projectConfig);
            $projectDir        = _CURRENT_PROJECT;
            $currentProjectDir = $flip[$projectDir] ?? $projectDir;
        }

        define('CURRENT_PROJECT', $currentProjectDir ?? $projectDir);
        define('PROJECT_DIR', suffix(PROJECTS_DIR . $projectDir));

        if( ! is_dir(PROJECT_DIR) )
        {
            trace('["'.$projectDir.'"] Project Directory Not Found!');
        }
    }

    /**
    * Is writable
    * 
    * Controls whether file permission is required in the operating system where the system is installed.
    * 
    * @param string $path
    * 
    * @return void
    */
    protected static function isWritable(String $path)
    {
        if( is_file($path) && ! is_writable($path) && \IS::software() === 'apache' )
        {   
            trace
            (
                'Please check the [file permissions]. Click the 
                    <a target="_blank" style="text-decoration:none" href="https://docs.znframework.com/getting-started/installation-instructions#sh42">
                        [documentation]
                    </a> 
                to see how to configure file permissions.'
            );
        }
    }

    /**
     * spl autoload register
     * 
     * @param void
     * 
     * @return void
     */
    public function register()
    {
        spl_autoload_register('Autoloader::run');
    }
}

# Alias Autoloader
class_alias('ZN\Classes\Autoloader', 'Autoloader');