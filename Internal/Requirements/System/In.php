<?php namespace ZN;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Services\URL;
use ZN\Services\URI;
use ZN\Helpers\Logger;
use ZN\DataTypes\Strings;
use ZN\FileSystem\Folder;
use ZN\ErrorHandling\Errors;
use ZN\IndividualStructures\IS;
use ZN\IndividualStructures\Lang;
use ZN\IndividualStructures\Import;

class In
{
    /**
     * Keep view data
     * 
     * @var array
     */
    public static $view       = [];
    
    /**
     * Keep masterpage data
     * 
     * @var array
     */
    public static $masterpage = [];

    /**
     * Changes project mode
     * 
     * @param string $mode - [publication|development|restoration]
     * @param int    $report = 1
     * 
     * @return void
     */
    public static function projectMode(String $mode, Int $report = -1)
    {
        switch( strtolower($mode) )
        {
            # Publication Release Mode
            # All faults are off.
            # It is recommended to use this mode after the completion of the project.
            case 'publication' :
                error_reporting(0);
            break;
            
            # Restoration Repair Mode
            # The appearance of the faults is relative.
            case 'restoration' :
            
            # Development Development Mode
            # All faults are open.
            case 'development' :
                error_reporting($report);
            break;
            
            # Default output
            default: trace('Invalid Application Mode! Available Options: ["development"], ["restoration"] or ["publication"]');
        }
    }

    /**
     * Invalid user requests are diverted to different pages.
     * 
     * @param string $type
     * @param bool   $bool
     * 
     * @return void
     */
    public static function invalidRequest(String $type, Bool $bool)
    {
        $invalidRequest = \Config::get('Services', 'route')['requestMethods'];

        if( $requestMethods = $invalidRequest[$type] )
        {
            $requestMethods = array_change_key_case($requestMethods);

            if( ! empty($requestMethod = $requestMethods[CURRENT_CFURI] ?? NULL) )
            {
                if( \Http::isRequestMethod(...(array) $requestMethod) === $bool )
                {
                    \Route::redirectInvalidRequest();
                }
            }
        }
    }

    /**
     * Creates the default project key.
     * 
     * @param string $fix = NULL
     * 
     * @return string
     */
    public static function defaultProjectKey(String $fix = NULL) : String
    {
        if( defined('_CURRENT_PROJECT') )
        {
            $containers = PROJECTS_CONFIG['containers'];

            if( ! empty($containers[_CURRENT_PROJECT]) )
            {
                return md5(URL::base(strtolower($containers[_CURRENT_PROJECT])) . $fix);
            }
        }

        return md5(URL::base(strtolower(CURRENT_PROJECT)) . $fix);
    }

    /**
     * protected is subdomain
     * 
     * @param void
     * 
     * @return bool
     */
    protected static function isSubdomain()
    {
        return (bool) (PROJECTS_CONFIG['directory']['others'][host()] ?? false);
    }

    /**
     * Get current project.
     * 
     * @param void
     * 
     * @return string
     */
    public static function getCurrentProject() : String
    {
        if( self::isSubdomain() )
        {
            return false;
        }

        return (CURRENT_PROJECT === DEFAULT_PROJECT ? '' : suffix(CURRENT_PROJECT));
    }

    /**
     * Get request uri.
     * 
     * @param void
     * 
     * @return string
     */
    public static function requestURI() : String
    {
        $requestUri = URI::active();
        $requestUri = self::cleanInjection(self::routeURI(rtrim($requestUri, '/')));

        return (string) $requestUri;
    }

    /**
     * Clean uri prefix
     * 
     * @param string $uri       = NULL
     * @param string $cleanData = NULL
     * 
     * @return string
     */
    public static function cleanURIPrefix(String $uri = NULL, String $cleanData = NULL) : String
    {
        $suffixData = suffix((string) $cleanData);

        if( ! empty($cleanData) && stripos($uri, $suffixData) === 0 )
        {
            $uri = substr($uri, strlen($suffixData));
        }

        return $uri;
    }

    /**
     * All of the routes are processed.
     * 
     * @param void
     * 
     * @return void
     */
    protected static function routeAll()
    {
        $externalRouteFiles = (array) Folder\FileList::allFiles(EXTERNAL_ROUTES_DIR);
        $routeFiles         = (array) Folder\FileList::allFiles(ROUTES_DIR);
        $files              = array_merge($externalRouteFiles, $routeFiles);

        if( ! empty($files)  )
        {
            foreach( $files as $file )
            {
                import($file);
            }

            \Route::all();
        }
    }

    /**
     * Set the new uri route.
     * 
     * @param string $requestUri = NULL
     * 
     * @return string
     */
    public static function routeURI(String $requestUri = NULL) : String
    {
        self::routeAll();

        $config = \Config::get('Services', 'route');

        if( $config['openController'] )
        {
            $internalDir = NULL;

            if( defined('_CURRENT_PROJECT') )
            {
                $configAppdir = PROJECTS_CONFIG['directory']['others'];

                if( is_array($configAppdir) )
                {
                    $internalDir = ! empty($configAppdir[$requestUri]) ? $requestUri : _CURRENT_PROJECT;
                }
                else
                {
                    $internalDir = _CURRENT_PROJECT;
                }
            }

            if
            (
                $requestUri === DIRECTORY_INDEX ||
                $requestUri === Lang::get()     ||
                $requestUri === $internalDir    ||
                empty($requestUri)
            )
            {
                $requestUri = $config['openController'];
            }
        }

        $uriChange   = $config['changeUri'];
        $patternType = $config['patternType'];

        if( ! empty($uriChange) ) foreach( $uriChange as $key => $val )
        {
            if( $patternType === 'classic' )
            {
                $requestUri = preg_replace(presuffix($key).'xi', $val, $requestUri);
            }
            else
            {
                $requestUri = \Regex::replace($key, $val, $requestUri, 'xi');
            }
        }

        return $requestUri;
    }

    /**
     * Clears the URI from the injection.
     * 
     * @param string $string = NULL
     * 
     * @return string
     */
    public static function cleanInjection(String $string = NULL) : String
    {
        $urlInjectionChangeChars = \Config::get('Security', 'urlChangeChars');

        return str_ireplace(array_keys($urlInjectionChangeChars), array_values($urlInjectionChangeChars), $string);
    }

    /**
     * Get benchmark report table
     * 
     * @param void
     * 
     * @return void
     */
    public static function benchmarkReport()
    {
        if( \Config::get('Project', 'benchmark') === true )
        {
            # System elapsed time calculating
            $elapsedTime = round(FINISH_BENCHMARK - START_BENCHMARK, 4);
            
            # Get memory usage
            $memoryUsage = memory_get_usage();

            # Get maximum memory usage
            $maxMemoryUsage = memory_get_peak_usage();

            # Template benchmark performance result table
            $benchmarkData =
            [
                'elapsedTime'    => $elapsedTime,
                'memoryUsage'    => $memoryUsage,
                'maxMemoryUsage' => $maxMemoryUsage
            ];

            $benchResult = Import\Template::use('BenchmarkTable', $benchmarkData, true);
            
            # Echo benchmark performance result table
            echo $benchResult;

            # Report log
            Logger::report('Benchmarking Test Result', $benchResult, 'BenchmarkTestResults');
        }

        # The layer that came in after the whole system.
        # The codes to be executed after the system runs are written to this layer.
        layer('Bottom');
    }

    /**
     * Configures the startup controller settings.
     * 
     * @param string $config
     * 
     * @return void
     */
    public static function startingConfig($config)
    {
        if( $destruct = \Config::get('Starting', $config) )
        {
            if( is_string($destruct) )
            {
                self::startingController($destruct);
            }
            elseif( is_array($destruct) )
            {
                foreach( $destruct as $key => $val )
                {
                    if( is_numeric($key) )
                    {
                        self::startingController($val);
                    }
                    else
                    {
                        self::startingController($key, $val);
                    }
                }
            }
        }
    }

    /**
     * Run the startup controllers.
     * 
     * @param string $startController = NULL
     * @param array  $param           = []
     * 
     * @return bool
     */
    public static function startingController(String $startController = NULL, Array $param = [])
    {
        $controllerEx = explode(':', $startController);

        $controllerPath  = ! empty($controllerEx[0]) ? $controllerEx[0] : '';
        $controllerFunc  = ! empty($controllerEx[1]) ? $controllerEx[1] : 'main';
        $controllerFile  = CONTROLLERS_DIR . suffix($controllerPath, '.php');
        $controllerClass = Strings\Split::divide($controllerPath, '/', -1);

        if( is_file($controllerFile) )
        {
            if( ! class_exists($controllerClass, false) )
            {
                $controllerClass = PROJECT_CONTROLLER_NAMESPACE . $controllerClass;
            }

            import($controllerFile);

            if( ! is_callable([$controllerClass, $controllerFunc]) )
            {
                Logger::report('Error', Lang::select('Error', 'callUserFuncArrayError', $controllerFunc), 'SystemCallUserFuncArrayError');

                throw new \GeneralException('Error', 'callUserFuncArrayError', $controllerFunc);
            }

            $exclude = $controllerClass . '::exclude';
            $include = $controllerClass . '::include';

            // Note: Added Control 5.2.0
            if( defined($exclude) )
            {
                if( in_array(CURRENT_CFURI, $controllerClass::exclude) || in_array(CURRENT_CONTROLLER, $controllerClass::exclude) )
                {
                    return false;
                }
            }

            // Note: Added Control 5.2.0
            if( defined($include) )
            {
                if( ! in_array(CURRENT_CFURI, $controllerClass::include) && ! in_array(CURRENT_CONTROLLER, $controllerClass::include) )
                {
                    return false;
                }
            }

            $startingControllerClass = uselib($controllerClass);

            $return = $startingControllerClass->$controllerFunc(...$param);

            self::$view[]       = array_merge((array) $startingControllerClass->view, \View::$data);
            self::$masterpage[] = array_merge((array) $startingControllerClass->masterpage, \Masterpage::$data);
        }
        else
        {
            return false;
        }
    }

    /**
     * Creates htaccess file.
     * 
     * @param void
     * 
     * @return void
     */
    public static function createHtaccessFile()
    {
        $htaccessSettings = \Config::get('Htaccess');

        $config = $htaccessSettings['cache'];
        $eol    = EOL;
        $tab    = HT;

        # GZIP
        # If mod_gzip = true is set, it adds the following codes.
        # GZIP starts caching.
        if( $config['modGzip']['status'] === true )
        {
            $modGzip  = '<ifModule mod_gzip.c>' . $eol;
            $modGzip .= $tab.'mod_gzip_on Yes' . $eol;
            $modGzip .= $tab.'mod_gzip_dechunk Yes' . $eol;
            $modGzip .= $tab.'mod_gzip_item_include file .('.$config['modGzip']['includedFileExtension'].')$' . $eol;
            $modGzip .= $tab.'mod_gzip_item_include handler ^cgi-script$' . $eol;
            $modGzip .= $tab.'mod_gzip_item_include mime ^text/.*' . $eol;
            $modGzip .= $tab.'mod_gzip_item_include mime ^application/x-javascript.*' . $eol;
            $modGzip .= $tab.'mod_gzip_item_exclude mime ^image/.*' . $eol;
            $modGzip .= $tab.'mod_gzip_item_exclude rspheader ^Content-Encoding:.*gzip.*' . $eol;
            $modGzip .= '</ifModule>' . $eol . $eol;
        }
        else
        {
            $modGzip = '';
        }

        # Expires
        # If mod_expires = true is set, it adds the following codes.
        # Crawler cache is initialized.
        if( $config['modExpires']['status'] === true )
        {
            $exp = '';
            foreach($config['modExpires']['fileTypeTime'] as $type => $value)
            {
                $exp .= $tab.'ExpiresByType '.$type.' "access plus '.$value.' seconds"'.$eol;
            }

            $modExpires  = '<ifModule mod_expires.c>' . $eol;
            $modExpires .= $tab.'ExpiresActive On' . $eol;
            $modExpires .= $tab.'ExpiresDefault "access plus '.$config['modExpires']['defaultTime'].' seconds"' . $eol;
            $modExpires .= rtrim($exp, $eol) . $eol;
            $modExpires .= '</ifModule>' . $eol . $eol;
        }
        else
        {
            $modExpires = '';
        }

        # Headers
        # If mod_headers = true is set, it adds the following codes.
        # Caching with header is started.
        if( $config['modHeaders']['status'] === true )
        {
            $fmatch = '';
            foreach( $config['modHeaders']['fileExtensionTimeAccess'] as $type => $value )
            {
                $fmatch .= $tab.'<filesMatch "\.('.$type.')$">' . $eol;
                $fmatch .= $tab.$tab.'Header set Cache-Control "max-age='.$value['time'].', '.$value['access'].'"' . $eol;
                $fmatch .= $tab.'</filesMatch>'.$eol;
            }

            $modHeaders  = '<ifModule mod_headers.c>' . $eol;
            $modHeaders .= rtrim($fmatch, $eol) . $eol;
            $modHeaders .= '</ifModule>' . $eol;
        }
        else
        {
            $modHeaders = '';
        }
      
        if( $htaccessSettings['headers']['status'] === true )
        {
            $headersIniSet  = "<ifModule mod_expires.c>".$eol;

            foreach( $htaccessSettings['headers']['settings'] as $val )
            {
                $headersIniSet .= $tab."$val".$eol;
            }

            $headersIniSet .= "</ifModule>".$eol.$eol;
        }
        else
        {
            $headersIniSet = '';
        }
   
        if( ! empty($htaccessSettings['settings']) )
        {
            $htaccessSettingsStr = '';

            foreach( $htaccessSettings['settings'] as $key => $val )
            {
                if( ! is_numeric($key) )
                {
                    if( is_array($val) )
                    {
                        $htaccessSettingsStr .= "<$key>".$eol;

                        foreach( $val as $k => $v)
                        {
                            if( ! is_numeric($k) )
                            {
                                $htaccessSettingsStr .= $tab."$k $v".$eol;
                            }
                            else
                            {
                                $htaccessSettingsStr .= $tab.$v.$eol;
                            }
                        }

                        $keyex = explode(" ", $key);
                        $htaccessSettingsStr .= "</$keyex[0]>".$eol.$eol;
                    }
                    else
                    {
                        $htaccessSettingsStr .= "$key $val".$eol;
                    }
                }
                else
                {
                    $htaccessSettingsStr .= $val.$eol;
                }
            }
        }
        else
        {
            $htaccessSettingsStr = '';
        }
     
        $htaccess  = '#----------------------------------------------------------------------'.$eol;
        $htaccess .= '# This file automatically created and updated'.$eol;
        $htaccess .= '#----------------------------------------------------------------------'.$eol.$eol;
        $htaccess .= $modGzip.$modExpires.$modHeaders.$headersIniSet.$htaccessSettingsStr;

        if( ! server('pathInfo') )
        {
            $indexSuffix = '?';  $flag = 'QSA';
        }
        else
        {
            $indexSuffix = NULL; $flag = 'L';
        }

        $htaccess .= "<IfModule mod_rewrite.c>".$eol;
        $htaccess .= $tab."RewriteEngine On".$eol;
        $htaccess .= $tab."RewriteBase /".$eol;
        $htaccess .= $tab."RewriteCond %{REQUEST_FILENAME} !-f".$eol;
        $htaccess .= $tab."RewriteCond %{REQUEST_FILENAME} !-d".$eol;
        $htaccess .= $tab.'RewriteRule ^(.*)$  '.($_SERVER['SCRIPT_NAME'] ?? NULL).$indexSuffix.'/$1 ['.$flag.']'.$eol;
        $htaccess .= "</IfModule>".$eol.$eol;
        $htaccess .= 'ErrorDocument 403 /'.BASE_DIR.DIRECTORY_INDEX.$eol.$eol;
        $htaccess .= 'DirectoryIndex '.DIRECTORY_INDEX.$eol.$eol;

        if( ! empty($uploadSet['status']) )
        {
            $uploadSettings = $htaccessSettings['upload'];
        }
        else
        {
            $uploadSettings = [];
        }
 
        if( ! empty($htaccessSettings['session']['status']) )
        {
            $sessionSettings = $htaccessSettings['session']['settings'];
        }
        else
        {
            $sessionSettings = [];
        }

        if( $htaccessSettings['ini']['status'] === true )
        {
            $iniSettings = $htaccessSettings['ini']['settings'];
        }
        else
        {
            $iniSettings = [];
        }
       
        $allSettings = array_merge($iniSettings, $uploadSettings, $sessionSettings);

        if( ! empty($allSettings) )
        {
            $sets = '';

            foreach( $allSettings as $k => $v )
            {
                if( $v !== '' )
                {
                    $sets .= $tab."php_value $k $v".$eol;
                }
            }

            if( ! empty($sets) )
            {
                $htaccess .= $eol."<IfModule mod_php5.c>".$eol;
                $htaccess .= $sets;
                $htaccess .= "</IfModule>" . $eol;
            }
        }

        $htaccessTxt = '.htaccess';

        if( is_file($htaccessTxt) )
        {
            $getContents = trim(file_get_contents($htaccessTxt));
        }
        else
        {
            $getContents = '';
        }

        $htaccess .= '#----------------------------------------------------------------------';
        $htaccess  = trim($htaccess);

        if( $htaccess === $getContents )
        {
            return false;
        }

        if( ! file_put_contents($htaccessTxt, trim($htaccess)) )
        {
            throw new \GeneralException('Error', 'fileNotWrite', $htaccessTxt);
        }
    }

    /**
     * Creates robots.txt
     * 
     * @param void
     * 
     * @return void
     */
    public static function createRobotsFile()
    {
        $rules  = \Config::get('Robots', 'rules');
        $robots = '';

        if( IS::array($rules) ) foreach( $rules as $key => $val )
        {
            if( ! is_numeric($key) ) # Single usage
            {
                switch( $key )
                {
                    case 'userAgent':
                        $robots .= ! empty( $val ) ? 'User-agent: '.$val.EOL : '';
                    break;

                    case 'allow'    :
                    case 'disallow' :
                        if( ! empty($val) ) foreach( $val as $v )
                        {
                            $robots .= ucfirst($key).': '.$v.EOL;
                        }
                    break;
                }
            }
            else
            {
                if( IS::array($val) ) foreach( $val as $r => $v ) # Multi usage
                {
                    switch( $r )
                    {
                        case 'userAgent':
                            $robots .= ! empty( $v ) ? 'User-agent: '.$v.EOL : '';
                        break;

                        case 'allow'    :
                        case 'disallow' :
                            if( ! empty($v) ) foreach( $v as $vr )
                            {
                                $robots .= ucfirst($r).': '.$vr.EOL;
                            }
                        break;
                    }
                }
            }
        }

        $robotTxt = 'robots.txt';

        if( is_file($robotTxt) )
        {
            $getContents = file_get_contents($robotTxt);
        }
        else
        {
            $getContents = '';
        }

        if( trim($robots) === trim($getContents) )
        {
            return false;
        }

        if( ! file_put_contents($robotTxt, trim($robots)) )
        {
            throw new \GeneralException('Error', 'fileNotWrite', $robotTxt);
        }
    }
}
