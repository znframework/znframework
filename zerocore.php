<?php
//--------------------------------------------------------------------------------------------------
// Kernel
//--------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// VERSION INFO CONSTANTS
//--------------------------------------------------------------------------------------------------
define('ZN_VERSION'          , '5.3.34');
define('REQUIRED_PHP_VERSION', '7.0.0');
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// REQUIREMENT CONSTANTS
//--------------------------------------------------------------------------------------------------
define('PROJECT_TYPE'                , 'EIP'                                                      );
define('DS'                          , DIRECTORY_SEPARATOR                                        );
define('REAL_BASE_DIR'               , realpath(__DIR__) . DS                                     );
define('INTERNAL_DIR' , REAL_BASE_DIR . (PROJECT_TYPE === 'SE' ? 'Libraries' : 'Internal') . DS   );
define('PROJECT_CONTROLLER_NAMESPACE', 'Project\Controllers\\'                                    );
define('PROJECT_COMMANDS_NAMESPACE'  , 'Project\Commands\\'                                       );
define('EXTERNAL_COMMANDS_NAMESPACE' , 'External\Commands\\'                                      );
define('DIRECTORY_INDEX'             , 'zeroneed.php'                                             );
define('INTERNAL_ACCESS'             , 'Internal'                                                 );
define('BASE_DIR'                    , explode(DIRECTORY_INDEX, $_SERVER['SCRIPT_NAME'])[0] ?? '/');
define('PROJECTS_DIR'                , REAL_BASE_DIR.'Projects'.DS                                );
define('EXTERNAL_DIR'                , REAL_BASE_DIR.(PROJECT_TYPE === 'SE' ? '' : 'External'.DS) );
define('SETTINGS_DIR'                , (PROJECT_TYPE === 'SE' ? 'Config' : 'Settings').DS         );
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// SPACE CHAR CONSTANTS
//--------------------------------------------------------------------------------------------------
define('EOL' , PHP_EOL);
define('CRLF', "\r\n" );
define('CR'  , "\r"   );
define('LF'  , "\n"   );
define('HT'  , "\t"   );
define('TAB' , "\t"   );
define('FF'  , "\f"   );
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// REQUIREMENT CONSTANTS
//--------------------------------------------------------------------------------------------------
define('PROJECTS_CONFIG'    , import
(
    (is_file(PROJECTS_DIR . 'Projects.php') ? PROJECTS_DIR : SETTINGS_DIR) . 'Projects.php'
));
define('DEFAULT_PROJECT'    , PROJECTS_CONFIG['directory']['default'] );
define('EXTERNAL_CONFIG_DIR', EXTERNAL_DIR . 'Config'.DS              );
define('INTERNAL_CONFIG_DIR', INTERNAL_DIR . 'Config'.DS              );
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Current Project
//--------------------------------------------------------------------------------------------------
//
// @param void
//
//--------------------------------------------------------------------------------------------------
internalCurrentProject();

//--------------------------------------------------------------------------------------------------
// DIRECTORY CONSTANTS
//--------------------------------------------------------------------------------------------------
//
// Almost every directory in the ZN Framework has constants. For this reason, these constants
// vary according to the project name. It can be quite useful for you.
//
//--------------------------------------------------------------------------------------------------
define('ROUTES_DIR'            , internalProjectContainerDir('Routes')     );
define('EXTERNAL_ROUTES_DIR'   , EXTERNAL_DIR.'Routes'.DS                  );
define('DATABASES_DIR'         , internalProjectContainerDir('Databases')  );
define('CONFIG_DIR'            , internalProjectContainerDir('Config')     );
define('STORAGE_DIR'           , internalProjectContainerDir('Storage')    );
define('COMMANDS_DIR'          , internalProjectContainerDir('Commands')   );
define('EXTERNAL_COMMANDS_DIR' , EXTERNAL_DIR.'Commands'.DS                );
define('RESOURCES_DIR'         , internalProjectContainerDir('Resources')  );
define('EXTERNAL_RESOURCES_DIR', EXTERNAL_DIR.'Resources'.DS               );
define('STARTING_DIR'          , internalProjectContainerDir('Starting')   );
define('EXTERNAL_STARTING_DIR' , EXTERNAL_DIR.'Starting'.DS                );
define('AUTOLOAD_DIR'          , STARTING_DIR.'Autoload'.DS                );
define('EXTERNAL_AUTOLOAD_DIR' , EXTERNAL_STARTING_DIR.'Autoload'.DS       );
define('HANDLOAD_DIR'          , STARTING_DIR.'Handload'.DS                );
define('EXTERNAL_HANDLOAD_DIR' , EXTERNAL_STARTING_DIR.'Handload'.DS       );
define('INTERNAL_LANGUAGES_DIR', INTERNAL_DIR.'Languages'.DS               );
define('LANGUAGES_DIR'         , internalProjectContainerDir('Languages')  );
define('EXTERNAL_LANGUAGES_DIR', EXTERNAL_DIR.'Languages'.DS               );
define('INTERNAL_LIBRARIES_DIR', INTERNAL_DIR.'Libraries'.DS               );
define('REQUIREMENTS_DIR'      , INTERNAL_DIR.'Requirements'.DS.'System'.DS);
define('LIBRARIES_DIR'         , internalProjectContainerDir('Libraries')  );
define('EXTERNAL_LIBRARIES_DIR', EXTERNAL_DIR.'Libraries'.DS               );
define('CONTROLLERS_DIR'       , PROJECT_DIR.'Controllers'.DS              );
define('MODELS_DIR'            , internalProjectContainerDir('Models')     );
define('EXTERNAL_MODELS_DIR'   , EXTERNAL_DIR.'Models'.DS                  );
define('VIEWS_DIR'             , PROJECT_DIR.'Views'.DS                    );
define('PAGES_DIR'             , VIEWS_DIR                                 );
define('PROCESSOR_DIR'         , RESOURCES_DIR.'Processor'.DS              );
define('EXTERNAL_PROCESSOR_DIR', EXTERNAL_RESOURCES_DIR.'Processor'.DS     );
define('FILES_DIR'             , RESOURCES_DIR.'Files'.DS                  );
define('EXTERNAL_FILES_DIR'    , EXTERNAL_RESOURCES_DIR.'Files'.DS         );
define('FONTS_DIR'             , RESOURCES_DIR.'Fonts'.DS                  );
define('EXTERNAL_FONTS_DIR'    , EXTERNAL_RESOURCES_DIR.'Fonts'.DS         );
define('SCRIPTS_DIR'           , RESOURCES_DIR.'Scripts'.DS                );
define('EXTERNAL_SCRIPTS_DIR'  , EXTERNAL_RESOURCES_DIR.'Scripts'.DS       );
define('STYLES_DIR'            , RESOURCES_DIR.'Styles'.DS                 );
define('EXTERNAL_STYLES_DIR'   , EXTERNAL_RESOURCES_DIR.'Styles'.DS        );
define('TEMPLATES_DIR'         , RESOURCES_DIR.'Templates'.DS              );
define('EXTERNAL_TEMPLATES_DIR', EXTERNAL_RESOURCES_DIR.'Templates'.DS     );
define('THEMES_DIR'            , RESOURCES_DIR.'Themes'.DS                 );
define('EXTERNAL_THEMES_DIR'   , EXTERNAL_RESOURCES_DIR.'Themes'.DS        );
define('PLUGINS_DIR'           , RESOURCES_DIR.'Plugins'.DS                );
define('EXTERNAL_PLUGINS_DIR'  , EXTERNAL_RESOURCES_DIR.'Plugins'.DS       );
define('UPLOADS_DIR'           , RESOURCES_DIR.'Uploads'.DS                );
define('EXTERNAL_UPLOADS_DIR'  , EXTERNAL_RESOURCES_DIR.'Uploads'.DS       );
define('INTERNAL_TEMPLATES_DIR', INTERNAL_DIR.'Templates'.DS               );
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Import Autoloader Library
//--------------------------------------------------------------------------------------------------
import(REQUIREMENTS_DIR . 'Autoloader.php');
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// STATUS CONSTANTS
//--------------------------------------------------------------------------------------------------
//
// Status Constants
//
//--------------------------------------------------------------------------------------------------
define('SSL_STATUS'  , ! Config::get('Services','uri')['ssl'] ? 'http://' : 'https://');
define('INDEX_STATUS', ! Config::get('Htaccess', 'uri')['directoryIndex'] ? '' : suffix(DIRECTORY_INDEX));
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Structure Data
//--------------------------------------------------------------------------------------------------
//
// Current Controller Constants
//
//--------------------------------------------------------------------------------------------------
define('STRUCTURE_DATA'     , ZN\Core\Structure::data()                );
define('CURRENT_COPEN_PAGE' , STRUCTURE_DATA['openFunction']           );
define('CURRENT_CPARAMETERS', STRUCTURE_DATA['parameters']             );
define('CURRENT_CFILE'      , STRUCTURE_DATA['file']                   );
define('CURRENT_CFUNCTION'  , STRUCTURE_DATA['function']               );
define('CURRENT_CPAGE'      , ($page = STRUCTURE_DATA['page']) . '.php');
define('CURRENT_CONTROLLER' , $page                                    );
define('CURRENT_CNAMESPACE' , $namespace = STRUCTURE_DATA['namespace'] );
define('CURRENT_CCLASS'     , $namespace . CURRENT_CONTROLLER          );
define('CURRENT_CFPATH'     , str_replace(CONTROLLERS_DIR, '', CURRENT_CONTROLLER).'/'.CURRENT_CFUNCTION);
define('CURRENT_CFURI'      , strtolower(CURRENT_CFPATH)               );
define('CURRENT_CFURL'      , siteUrl(CURRENT_CFPATH)                  );
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// URL CONSTANTS
//--------------------------------------------------------------------------------------------------
//
// Useful current constants.
//
//--------------------------------------------------------------------------------------------------
define('BASE_URL'     , URL::base()             );
define('SITE_URL'     , URL::site()             );
define('CURRENT_URL'  , URL::current()          );
define('PREV_URL'     , URL::prev()             );
define('HOST_URL'     , URL::host()             );
define('BASE_PATH'    , URI::base()             );
define('CURRENT_PATH' , URI::current()          );
define('PREV_PATH'    , URI::prev()             );
define('HOST'         , host()                  );
define('HOST_NAME'    , HOST                    );
define('FILES_URL'    , URL::base(FILES_DIR)    );
define('FONTS_URL'    , URL::base(FONTS_DIR)    );
define('PLUGINS_URL'  , URL::base(PLUGINS_DIR)  );
define('SCRIPTS_URL'  , URL::base(SCRIPTS_DIR)  );
define('STYLES_URL'   , URL::base(STYLES_DIR)   );
define('THEMES_URL'   , URL::base(THEMES_DIR)   );
define('UPLOADS_URL'  , URL::base(UPLOADS_DIR)  );
define('RESOURCES_URL', URL::base(RESOURCES_DIR));
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Illustrate
//--------------------------------------------------------------------------------------------------
//
// @param string $const
// @param  mixed $value
// @return mixed
//
//--------------------------------------------------------------------------------------------------
function illustrate(String $const, $value = '')
{
    if( ! defined($const) )
    {
        define($const, $value);
    }
    else
    {
        if( $value !== '' )
        {
            return $value;
        }
    }

    return constant($const);
}

//--------------------------------------------------------------------------------------------------
// CSRFInput
//--------------------------------------------------------------------------------------------------
//
// @param string data
//
// @return int
//
//--------------------------------------------------------------------------------------------------
function CSRFInput()
{
    Session::insert('token', Encode::create(32));

    return Form::hidden('token', Session::select('token'));
}

//--------------------------------------------------------------------------------------------------
// Length
//--------------------------------------------------------------------------------------------------
//
// @param string data
//
// @return int
//
//--------------------------------------------------------------------------------------------------
function length($data) : Int
{
    return ! is_scalar($data)
           ? count((array) $data)
           : strlen($data);
}

//--------------------------------------------------------------------------------------------------
// headers()
//--------------------------------------------------------------------------------------------------
//
// @param mixed $header
//
//--------------------------------------------------------------------------------------------------
function headers($header)
{
    if( empty($header) )
    {
        return false;
    }

    if( ! is_array($header) )
    {
         header($header);
    }
    else
    {
        if( ! empty($header) ) foreach( $header as $k => $v )
        {
            header($v);
        }
    }
}

//--------------------------------------------------------------------------------------------------
// currentUri()
//--------------------------------------------------------------------------------------------------
//
// @param bool $fullPath = false
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function currentUri(Bool $fullPath = false) : String
{
    return URI::active($fullPath);
}

//--------------------------------------------------------------------------------------------------
// getLang()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function getLang() : String
{
    return Lang::get();
}

//--------------------------------------------------------------------------------------------------
// setLang()
//--------------------------------------------------------------------------------------------------
//
// @param string $l
//
// @return bool
//
//--------------------------------------------------------------------------------------------------
function setLang(String $l = NULL) : Bool
{
    return Lang::set($l);
}

//--------------------------------------------------------------------------------------------------
// lang()
//--------------------------------------------------------------------------------------------------
//
// @param string $file
// @param string $str
// @param mixed  $changed
//
// @return mixed
//
//--------------------------------------------------------------------------------------------------
function lang(String $file = NULL, String $str = NULL, $changed = NULL)
{
    return Lang::select($file, $str, $changed);
}

//--------------------------------------------------------------------------------------------------
// currentLang()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function currentLang() : String
{
    return Lang::current();
}

//--------------------------------------------------------------------------------------------------
// currentUrl()
//--------------------------------------------------------------------------------------------------
//
// @param string $fix
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function currentUrl(String $fix = NULL) : String
{
    return URL::current($fix);
}

//--------------------------------------------------------------------------------------------------
// siteUrl()
//--------------------------------------------------------------------------------------------------
//
// @param string $uri
// @param int    $index
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function siteUrl(String $uri = NULL, Int $index = 0) : String
{
    return URL::site($uri, $index);
}

//--------------------------------------------------------------------------------------------------
// siteUrls() - v.4.2.6
//--------------------------------------------------------------------------------------------------
//
// @param string $uri
// @param int    $index
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function siteUrls(String $uri = NULL, Int $index = 0) : String
{
    return URL::sites($uri, $index);
}

//--------------------------------------------------------------------------------------------------
// baseUrl()
//--------------------------------------------------------------------------------------------------
//
// @param string $uri
// @param int    $index
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function baseUrl(String $uri = NULL, Int $index = 0) : String
{
    return URL::base($uri, $index);
}

//--------------------------------------------------------------------------------------------------
// prevUrl()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function prevUrl() : String
{
    return URL::prev();
}

//--------------------------------------------------------------------------------------------------
// hostUrl()
//--------------------------------------------------------------------------------------------------
//
// @param string $uri
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function hostUrl(String $uri = NULL) : String
{
    return URL::host($uri);
}

//--------------------------------------------------------------------------------------------------
// currentPath()
//--------------------------------------------------------------------------------------------------
//
// @param bool $isPath
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function currentPath(Bool $isPath = true) : String
{
    return URI::current($isPath);
}

//--------------------------------------------------------------------------------------------------
// basePath()
//--------------------------------------------------------------------------------------------------
//
// @param string $uri
// @param int    $index
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function basePath(String $uri = NULL, Int $index = 0) : String
{
    return URI::base($uri, $index);
}

//--------------------------------------------------------------------------------------------------
// prevPath()
//--------------------------------------------------------------------------------------------------
//
// @param bool $isPath
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function prevPath(Bool $isPath = true) : String
{
    return URI::prev($isPath);
}

//--------------------------------------------------------------------------------------------------
// redirect()
//--------------------------------------------------------------------------------------------------
//
// @param string $url
// @param int    $time
// @param array  $data
// @param bool   $exit
//
//--------------------------------------------------------------------------------------------------
function redirect(String $url = NULL, Int $time = 0, Array $data = NULL, Bool $exit = true)
{
    Redirect::location($url, $time, $data, $exit);
}

//--------------------------------------------------------------------------------------------------
// redirectData()
//--------------------------------------------------------------------------------------------------
//
// @param string $k
//
// @return mixed
//
//--------------------------------------------------------------------------------------------------
function redirectData(String $k)
{
    Redirect::selectData($k);
}

//--------------------------------------------------------------------------------------------------
// redirectDeleteData()
//--------------------------------------------------------------------------------------------------
//
// @param mixed $data
//
// @return bool
//
//--------------------------------------------------------------------------------------------------
function redirectDeleteData($data) : Bool
{
    Redirect::deleteData($data);
}

//--------------------------------------------------------------------------------------------------
// internalDefaultProjectKey()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function internalDefaultProjectKey()
{
    return ZN\In::defaultProjectKey();
}

//--------------------------------------------------------------------------------------------------
// library()
//--------------------------------------------------------------------------------------------------
//
// @param string $class
// @param string $function
// @param mixed  $parameters
//
// @return callable
//
//--------------------------------------------------------------------------------------------------
function library(String $class, String $function, $parameters = [])
{
    $var = uselib($class);

    if( ! is_array($parameters) )
    {
        $parameters = [$parameters];
    }

    if( is_callable([$var, $function]) )
    {
        return call_user_func_array([$var, $function], $parameters);
    }
    else
    {
        return false;
    }
}

//--------------------------------------------------------------------------------------------------
// uselib()
//--------------------------------------------------------------------------------------------------
//
// @param string $class
// @param array  $parameters
//
// @return class
//
//--------------------------------------------------------------------------------------------------
function uselib(String $class, Array $parameters = [])
{
    if( ! class_exists($class) )
    {
        $classInfo = Autoloader::getClassFileInfo($class);

        $class = $classInfo['namespace'];

        if( ! class_exists($class) )
        {
            die(\Errors::message('Error', 'classError', $class));
        }
    }

    if( ! isset(ZN::$use->$class) )
    {
        if( ! is_object(ZN::$use) )
        {
            ZN::$use = new stdClass();
        }

        ZN::$use->$class = new $class(...$parameters);
    }

    return ZN::$use->$class;
}

//--------------------------------------------------------------------------------------------------
// Import
//--------------------------------------------------------------------------------------------------
//
// Require Once
//
//--------------------------------------------------------------------------------------------------
function import(String $file)
{
    $constant = 'ImportFilePrefix' . $file;

    if( ! defined($constant) )
    {
        define($constant, true);

        $file = prefix($file, REAL_BASE_DIR);

        if( is_file($file) )
        {
            return require $file;
        }

        return false;
    }
}

//--------------------------------------------------------------------------------------------------
// trace()
//--------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//
//--------------------------------------------------------------------------------------------------
function trace(String $message)
{
    $style  = 'border:solid 1px #E1E4E5;';
    $style .= 'background:#FEFEFE;';
    $style .= 'padding:10px;';
    $style .= 'margin-bottom:10px;';
    $style .= 'font-family:Calibri, Ebrima, Century Gothic, Consolas, Courier New, Courier, monospace, Tahoma, Arial;';
    $style .= 'color:#666;';
    $style .= 'text-align:left;';
    $style .= 'font-size:14px;';

    $message = preg_replace('/\[(.*?)\]/', '<span style="color:#990000;">$1</span>', $message);

    $str  = "<div style=\"$style\">";
    $str .= $message;
    $str .= '</div>';

    exit($str);
}

//--------------------------------------------------------------------------------------------------
// isPhpVersion()
//--------------------------------------------------------------------------------------------------
//
// İşlev: Parametrenin geçerli php sürümü olup olmadığını kontrol eder.
// Parametreler: $version => Geçerliliği kontrol edilecek veri.
// Dönen Değerler: Geçerli sürümse true değilse false değerleri döner.
//
//--------------------------------------------------------------------------------------------------
function isPhpVersion(String $version = '5.2.4')
{
    return IS::phpVersion($version);
}

//--------------------------------------------------------------------------------------------------
// absoluteRelativePath()
//--------------------------------------------------------------------------------------------------
//
// Gerçek yolu yalın yola çevirir.
//
//--------------------------------------------------------------------------------------------------
function absoluteRelativePath(String $path = NULL)
{
    return File::absolutePath($path);
}

//--------------------------------------------------------------------------------------------------
// isUrl()
//--------------------------------------------------------------------------------------------------
//
// @param string $url
//
// @return Bool
//
//--------------------------------------------------------------------------------------------------
function isUrl(String $url) : Bool
{
    return IS::url($url);
}

//--------------------------------------------------------------------------------------------------
// isEmail()
//--------------------------------------------------------------------------------------------------
//
// @param string $email
//
// @return Bool
//
//--------------------------------------------------------------------------------------------------
function isEmail(String $email) : Bool
{
    return IS::email($email);
}

//--------------------------------------------------------------------------------------------------
// isChar()
//--------------------------------------------------------------------------------------------------
//
// @param mixed $str
//
// @return Bool
//
//--------------------------------------------------------------------------------------------------
function isChar($str) : Bool
{
    return IS::char($str);
}

//--------------------------------------------------------------------------------------------------
// isHash()
//--------------------------------------------------------------------------------------------------
//
// @param string $type
//
// @return Bool
//
//--------------------------------------------------------------------------------------------------
function isHash(String $type) : Bool
{
    return IS::hash($type);
}

//--------------------------------------------------------------------------------------------------
// isCharset()
//--------------------------------------------------------------------------------------------------
//
// @param string $charset
//
// @return Bool
//
//--------------------------------------------------------------------------------------------------
function isCharset(String $charset) : Bool
{
    return IS::charset($charset);
}

//--------------------------------------------------------------------------------------------------
// isArray
//--------------------------------------------------------------------------------------------------
//
// @param mixed $array
//
// @return Bool
//
//--------------------------------------------------------------------------------------------------
function isArray($array) : Bool
{
    return IS::array($array);
}

//--------------------------------------------------------------------------------------------------
// Null Coalesce
//--------------------------------------------------------------------------------------------------
//
// @param var   &$var
// @param mixed $value
//
// @return void
//
//--------------------------------------------------------------------------------------------------
function nullCoalesce( & $var, $value)
{
    Coalesce::null($var, $value);
}

//--------------------------------------------------------------------------------------------------
// False Coalesce
//--------------------------------------------------------------------------------------------------
//
// @param var   &$var
// @param mixed $value
//
// @return void
//
//--------------------------------------------------------------------------------------------------
function falseCoalesce( & $var, $value)
{
    Coalesce::false($var, $value);
}

//--------------------------------------------------------------------------------------------------
// Empty Coalesce
//--------------------------------------------------------------------------------------------------
//
// @param var   &$var
// @param mixed $value
//
// @return void
//
//--------------------------------------------------------------------------------------------------
function emptyCoalesce( & $var, $value)
{
    Coalesce::empty($var, $value);
}

//--------------------------------------------------------------------------------------------------
// output()
//--------------------------------------------------------------------------------------------------
//
// @param mixed $data
// @param array $settings = []
// @param bool  $content  = false
//
// @return void
//
//--------------------------------------------------------------------------------------------------
function output($data, Array $settings = NULL, Bool $content = false)
{
    return Output::display($data, $settings, $content);
}

//--------------------------------------------------------------------------------------------------
// write()
//--------------------------------------------------------------------------------------------------
//
// @param string $data
// @param array  $vars = []
//
// @return void
//
//--------------------------------------------------------------------------------------------------
function write($data = NULL, Array $vars = NULL)
{
    Output::write($data, $vars);
}

//--------------------------------------------------------------------------------------------------
// writeLine()
//--------------------------------------------------------------------------------------------------
//
// @param string $data
// @param array  $vars    = []
// @param int    $brCount = 1
//
// @return void
//
//--------------------------------------------------------------------------------------------------
function writeLine($data = NULL, Array $vars = NULL, Int $brCount = 1)
{
    Output::writeLine($data, $vars, $brCount);
}

//--------------------------------------------------------------------------------------------------
// ipv4()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function ipv4() : String
{
    return User::ip();
}

//--------------------------------------------------------------------------------------------------
// server()
//--------------------------------------------------------------------------------------------------
//
// @param string $type = ''
//
// @return mixed
//
//--------------------------------------------------------------------------------------------------
function server(String $type = NULL)
{
    $server =
    [
        NULL                         => $_SERVER,
        'name'                       => $_SERVER['SERVER_NAME']           ?? false,
        'admin'                      => $_SERVER['SERVER_ADMIN']          ?? false,
        'addr'                       => $_SERVER['SERVER_ADDR']           ?? false,
        'port'                       => $_SERVER['SERVER_PORT']           ?? false,
        'protocol'                   => $_SERVER['SERVER_PROTOCOL']       ?? false,
        'signature'                  => $_SERVER['SERVER_SIGNATURE']      ?? false,
        'software'                   => $_SERVER['SERVER_SOFTWARE']       ?? false,
        'remoteAddr'                 => $_SERVER['REMOTE_ADDR']           ?? false,
        'remotePort'                 => $_SERVER['REMOTE_PORT']           ?? false,
        'requestMethod'              => $_SERVER['REQUEST_METHOD']        ?? false,
        'requestUri'                 => $_SERVER['REQUEST_URI']           ?? false,
        'requestScheme'              => $_SERVER['REQUEST_SCHEME']        ?? false,
        'requestTime'                => $_SERVER['REQUEST_TIME']          ?? false,
        'requestTimeFloat'           => $_SERVER['REQUEST_TIME_FLOAT']    ?? false,
        'accept'                     => $_SERVER['HTTP_ACCEPT']           ?? false,
        'acceptCharset'              => $_SERVER['HTTP_ACCEPT_CHARSET']   ?? false,
        'acceptEncoding'             => $_SERVER['HTTP_ACCEPT_ENCODING']  ?? false,
        'acceptLanguage'             => $_SERVER['HTTP_ACCEPT_LANGUAGE']  ?? false,
        'clientIp'                   => $_SERVER['HTTP_CLIENT_IP']        ?? false,
        'xForwardedHost'             => $_SERVER['HTTP_X_FORWARDED_HOST'] ?? false,
        'xForwardedFor'              => $_SERVER['HTTP_X_FORWARDED_FOR']  ?? false,
        'xOriginalUrl'               => $_SERVER['HTTP_X_ORIGINAL_URL']   ?? false,
        'xRequestedWith'             => $_SERVER['HTTP_X_REQUESTED_WITH'] ?? false,
        'connection'                 => $_SERVER['HTTP_CONNECTION']       ?? false,
        'host'                       => $_SERVER['HTTP_HOST']             ?? false,
        'referer'                    => $_SERVER['HTTP_REFERER']          ?? false,
        'userAgent'                  => $_SERVER['HTTP_USER_AGENT']       ?? false,
        'cookie'                     => $_SERVER['HTTP_COOKIE']           ?? false,
        'cacheControl'               => $_SERVER['HTTP_CACHE_CONTROL']    ?? false,
        'https'                      => $_SERVER['HTTPS']                 ?? false,
        'scriptFileName'             => $_SERVER['SCRIPT_FILENAME']       ?? false,
        'scriptName'                 => $_SERVER['SCRIPT_NAME']           ?? false,
        'path'                       => $_SERVER['PATH']                  ?? false,
        'pathInfo'                   => $_SERVER['PATH_INFO']             ?? false,
        'currentPath'                => $_SERVER['PATH_INFO']             ?? $_SERVER['QUERY_STRING'] ?? false,
        'pathTranslated'             => $_SERVER['PATH_TRANSLATED']       ?? false,
        'pathext'                    => $_SERVER['PATHEXT']               ?? false,
        'redirectQueryString'        => $_SERVER['REDIRECT_QUERY_STRING'] ?? false,
        'redirectUrl'                => $_SERVER['REDIRECT_URL']          ?? false,
        'redirectStatus'             => $_SERVER['REDIRECT_STATUS']       ?? false,
        'phpSelf'                    => $_SERVER['PHP_SELF']              ?? false,
        'queryString'                => $_SERVER['QUERY_STRING']          ?? false,
        'documentRoot'               => $_SERVER['DOCUMENT_ROOT']         ?? false,
        'windir'                     => $_SERVER['WINDIR']                ?? false,
        'comspec'                    => $_SERVER['COMSPEC']               ?? false,
        'systemRoot'                 => $_SERVER['SystemRoot']            ?? false,
        'gatewayInterface'           => $_SERVER['GATEWAY_INTERFACE']     ?? false
    ];

    if( isset($server[$type]) )
    {
        if( is_array($server[$type]) )
        {
            return $server[$type];
        }
        else
        {
            return htmlspecialchars($server[$type], ENT_QUOTES, "utf-8");
        }
    }
    elseif( isset($_SERVER[$type]) )
    {
        return htmlspecialchars($_SERVER[$type], ENT_QUOTES, "utf-8");
    }

    return false;
}

//--------------------------------------------------------------------------------------------------
// pathInfos()
//--------------------------------------------------------------------------------------------------
//
// @param string $file
// @param string $info = 'basename'
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function pathInfos(String $file, String $info = 'basename') : String
{
    return File::pathInfo($file, $info);
}

//--------------------------------------------------------------------------------------------------
// extension()
//--------------------------------------------------------------------------------------------------
//
// @param string $file
// @param bool   $dote = false
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function extension(String $file, Bool $dote = false) : String
{
    return File::extension($file, $dote);
}

//--------------------------------------------------------------------------------------------------
// removeExtension()
//--------------------------------------------------------------------------------------------------
//
// @param string $file
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function removeExtension(String $file) : String
{
    return File::removeExtension($file);
}

//--------------------------------------------------------------------------------------------------
// host()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function host() : String
{
    if( isset($_SERVER['HTTP_X_FORWARDED_HOST']) )
    {
        $host     = $_SERVER['HTTP_X_FORWARDED_HOST'];
        $elements = explode(',', $host);
        $host     = trim(end($elements));
    }
    else
    {
        $host = $_SERVER['HTTP_HOST']   ??
                $_SERVER['SERVER_NAME'] ??
                $_SERVER['SERVER_ADDR'] ??
                '';
    }

    return trim($host);
}

//--------------------------------------------------------------------------------------------------
// hostName()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function hostName() : String
{
    return host();
}

//--------------------------------------------------------------------------------------------------
// charsetList()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return array
//
//--------------------------------------------------------------------------------------------------
function charsetList() : Array
{
    return mb_list_encodings();
}

//--------------------------------------------------------------------------------------------------
// compare()
//--------------------------------------------------------------------------------------------------
//
// @param string $p1
// @param string $p2
// @param string $p3
//
// @return Bool
//
//--------------------------------------------------------------------------------------------------
function compare(String $p1, String $operator, String $p2) : Bool
{
    return version_compare($p1, $p2, $operator);
}

//--------------------------------------------------------------------------------------------------
// suffix()
//--------------------------------------------------------------------------------------------------
//
// @param string $string
// @param string $fix = '/'
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function suffix(String $string = NULL, String $fix = '/') : String
{
    if( strlen($fix) <= strlen($string) )
    {
        $suffix = substr($string, -strlen($fix));

        if( $suffix !== $fix)
        {
            $string = $string.$fix;
        }
    }
    else
    {
        $string = $string.$fix;
    }

    if( $string === '/' )
    {
        return false;
    }

    return $string;
}

//--------------------------------------------------------------------------------------------------
// prefix()
//--------------------------------------------------------------------------------------------------
//
// @param string $string
// @param string $fix = '/'
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function prefix(String $string = NULL, String $fix = '/') : String
{
    if( strlen($fix) <= strlen($string) )
    {
        $prefix = substr($string, 0, strlen($fix));

        if( $prefix !== $fix )
        {
            $string = $fix.$string;
        }
    }
    else
    {
        $string = $fix.$string;
    }

    if( $string === '/' )
    {
        return false;
    }

    return $string;
}

//--------------------------------------------------------------------------------------------------
// presuffix()
//--------------------------------------------------------------------------------------------------
//
// @param string $string
// @param string $fix = '/'
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function presuffix(String $string = NULL, String $fix = '/') : String
{
    return suffix(prefix(empty($string) ? $fix.$string.$fix : $string, $fix), $fix);
}

//--------------------------------------------------------------------------------------------------
// internalProjectContainerDir)
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @param string
//
//--------------------------------------------------------------------------------------------------
function internalProjectContainerDir($path = NULL) : String
{
    $path = suffix($path, DS);

    if( PROJECT_TYPE === 'SE' )
    {
        return $path;
    }

    $containers          = PROJECTS_CONFIG['containers'];
    $containerProjectDir = PROJECT_DIR . $path;

    if( ! empty($containers) && defined('_CURRENT_PROJECT') )
    {
        return ! empty($containers[_CURRENT_PROJECT]) && ! file_exists($containerProjectDir)
               ? PROJECTS_DIR . suffix($containers[_CURRENT_PROJECT], DS) . $path
               : $containerProjectDir;
    }

    // 5.3.33[edited]
    if( is_dir($containerProjectDir) )
    {
        return $containerProjectDir;
    }

    // 5.1.5 -> The enclosures can be the opening controller
    if( $container = ($containers[CURRENT_PROJECT] ?? NULL) )
    {
        $containerProjectDir = str_replace(CURRENT_PROJECT, $container, $containerProjectDir);
    }

    return $containerProjectDir;
}

//--------------------------------------------------------------------------------------------------
// Internal Current Project
//--------------------------------------------------------------------------------------------------
//
// @param void
//
//--------------------------------------------------------------------------------------------------
function internalCurrentProject()
{
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

        // 5.0.3 -> Updated -------------------------------------------------------
        //
        // QUERY_STRING & REQUEST URI Empty Control
		if( empty($currentPath) && ($requestUri = server('requestUri')) !== '/' )
		{
			$currentPath = $requestUri;
		}
        // ------------------------------------------------------------------------

        $internalDir   = ( ! empty($currentPath) ? explode('/', ltrim($currentPath, '/'))[0] : '' );
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
    define('PROJECT_DIR', suffix(PROJECTS_DIR . $projectDir, DS));

    if( ! is_dir(PROJECT_DIR) )
    {
        trace('["'.$projectDir.'"] Project Directory Not Found!');
    }
}
