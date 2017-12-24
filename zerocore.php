<?php
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

/*
|--------------------------------------------------------------------------
| Project Type
|--------------------------------------------------------------------------
|
| It shows you which framework you are using.
| SE for single edition, EIP for multi edition.
|
*/

define('PROJECT_TYPE', 'EIP');

/*
|--------------------------------------------------------------------------
| Version Information Constants
|--------------------------------------------------------------------------
|
| Contains the version information required for the Framework.
|
*/

define('ZN_VERSION', '5.4.78');
define('REQUIRED_PHP_VERSION', '7.0.0');

/*
|--------------------------------------------------------------------------
| System Path Constants
|--------------------------------------------------------------------------
|
| Constants that hold the values required for the system.
|
*/

define('DS', DIRECTORY_SEPARATOR);
define('REAL_BASE_DIR', realpath(__DIR__) . DS);

/*
|--------------------------------------------------------------------------
| System Basic Constants
|--------------------------------------------------------------------------
|
| Keeps information about the system's boot page and its base directory.
|
*/

define('DIRECTORY_INDEX', 'zeroneed.php');
define('BASE_DIR', ltrim(explode
(
    DIRECTORY_INDEX, $_SERVER['SCRIPT_NAME'])[0], '/')
);

/*
|--------------------------------------------------------------------------
| Namespace Constants
|--------------------------------------------------------------------------
|
| It keeps the default namespace information used by the system.
|
*/

define('PROJECT_CONTROLLER_NAMESPACE', 'Project\Controllers\\');
define('PROJECT_COMMANDS_NAMESPACE', 'Project\Commands\\');
define('EXTERNAL_COMMANDS_NAMESPACE', 'External\Commands\\');
define('INTERNAL_ACCESS', 'Internal');

/*
|--------------------------------------------------------------------------
| System Path Constants
|--------------------------------------------------------------------------
|
| It keeps the names of the system's base directories.
|
*/

define('INTERNAL_DIR', 
(
    PROJECT_TYPE === 'SE' ? 'Libraries' : 'Internal') . '/'
);
define('PROJECTS_DIR', 'Projects/');
define('EXTERNAL_DIR', (PROJECT_TYPE === 'SE' ? '' : 'External/'));
define('SETTINGS_DIR', (PROJECT_TYPE === 'SE' ? 'Config' : 'Settings').'/');

/*
|--------------------------------------------------------------------------
| Project Config Constant
|--------------------------------------------------------------------------
|
| It maintains settings related to the entire project. 
| The Settings / Projects.php configuration file is used.
|
*/

define('PROJECTS_CONFIG', import
((
    is_file(PROJECTS_DIR . 'Projects.php') 
    ? PROJECTS_DIR 
    : SETTINGS_DIR) . 'Projects.php'
));

/*
|--------------------------------------------------------------------------
| Default Project Constant
|--------------------------------------------------------------------------
|
| Preserves the name of the working default project.
|
*/

define('DEFAULT_PROJECT', PROJECTS_CONFIG['directory']['default']);

/*
|--------------------------------------------------------------------------
| Config Directory Constants
|--------------------------------------------------------------------------
|
| It keeps track of the internal and external configuration directories.
|
*/

define('EXTERNAL_CONFIG_DIR', EXTERNAL_DIR . 'Config/');
define('INTERNAL_CONFIG_DIR', INTERNAL_DIR . 'Config/');

/*
|--------------------------------------------------------------------------
| Space Char Constants
|--------------------------------------------------------------------------
|
| Commonly used space characters are converted to constants.
|
*/

define('EOL' , PHP_EOL);
define('CRLF', "\r\n" );
define('CR'  , "\r"   );
define('LF'  , "\n"   );
define('HT'  , "\t"   );
define('TAB' , "\t"   );
define('FF'  , "\f"   );

/*
|--------------------------------------------------------------------------
| Run Current Project
|--------------------------------------------------------------------------
|
| It processes the currently running project directory. 
| Only for multi edition. 
| This function is not compiled for single edition.
|
*/

internalCurrentProject();

/*
|--------------------------------------------------------------------------
| Project Directory Constants
|--------------------------------------------------------------------------
|
| Each of the project indexes is converted to constant.
|
*/

define('REQUIREMENTS_DIR', INTERNAL_DIR.'Requirements/System/');
define('CONTROLLERS_DIR' , PROJECT_DIR.'Controllers/');
define('VIEWS_DIR'       , PROJECT_DIR.'Views/');
define('PAGES_DIR'       , VIEWS_DIR);

/*
|--------------------------------------------------------------------------
| Active Project Directory Constants
|--------------------------------------------------------------------------
|
| Almost every directory in the ZN Framework has constants. 
| For this reason, these constants vary according to the project name. 
| It can be quite useful for you.
|
*/

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
    if( PROJECT_TYPE === 'EIP' ) // For EIP edition
    {
        define($key, internalProjectContainerDir($value));
        define('EXTERNAL_' . $key, 'External/' . $value);
    }
    else // For SE edition
    {
        define($key, $value);
    }
}


/*
|--------------------------------------------------------------------------
| Top Layer
|--------------------------------------------------------------------------
|
| The code to be written to this layer runs before the system files are 
| loaded. For this reason, you can not use ZN libraries.
|
*/

layer('Top');

/*
|--------------------------------------------------------------------------
| Autoloader
|--------------------------------------------------------------------------
|
| ZN Framework uses its own autoloader system, unlike other 
| implementations. In this system, the libraries are written to 
| Config/ClassMap.php file. Subsequent calls are made from this file.
|
*/

import(REQUIREMENTS_DIR . 'Autoloader.php');

/*
|--------------------------------------------------------------------------
| SSL Status Constants
|--------------------------------------------------------------------------
|
| If the value of ssl is on on the server, the links generated by the 
| URL library are output as https.
|
*/

define('SSL_STATUS', (server('https') === 'on' ? 'https' : 'http') . '://');

/*
|--------------------------------------------------------------------------
| URL & Path Constants
|--------------------------------------------------------------------------
|
| It keeps the path information to be used for various purposes.
|
*/

define('HOST', host());
define('HOST_NAME', HOST);
define('HOST_URL', SSL_STATUS . HOST . '/');
define('BASE_URL', HOST_URL . BASE_DIR);
define('SITE_URL', URL::site());
define('CURRENT_URL', rtrim(HOST_URL, '/') . ($_SERVER['REQUEST_URI'] ?? NULL));
define('PREV_URL', $_SERVER['HTTP_REFERER'] ?? NULL);
define('BASE_PATH', BASE_DIR);
define('CURRENT_PATH', URI::current());
define('PREV_PATH', str_replace(SITE_URL, NULL, PREV_URL));
define('FILES_URL', BASE_URL . FILES_DIR);
define('FONTS_URL', BASE_URL . FONTS_DIR);
define('PLUGINS_URL', BASE_URL . PLUGINS_DIR);
define('SCRIPTS_URL', BASE_URL . SCRIPTS_DIR);
define('STYLES_URL', BASE_URL . STYLES_DIR);
define('THEMES_URL', BASE_URL . THEMES_DIR);
define('UPLOADS_URL', BASE_URL . UPLOADS_DIR);
define('RESOURCES_URL', BASE_URL . RESOURCES_DIR);

/*
|--------------------------------------------------------------------------
| Top Bottom Layer
|--------------------------------------------------------------------------
|
| You can use system constants and libraries in this layer since the code 
| to write to this layer is used immediately after the auto loader. 
| All Config files can be configured on this layer since this layer runs 
| immediately after the auto installer.
|
*/

layer('TopBottom');


/*
|--------------------------------------------------------------------------
| Strucutre Constants
|--------------------------------------------------------------------------
|
| Provides data about the current working url.
|
*/

define('STRUCTURE_DATA', ZN\Core\Structure::data());
define('CURRENT_COPEN_PAGE', STRUCTURE_DATA['openFunction']);
define('CURRENT_CPARAMETERS', STRUCTURE_DATA['parameters']);
define('CURRENT_CFILE', STRUCTURE_DATA['file']);
define('CURRENT_CFUNCTION', STRUCTURE_DATA['function']);
define('CURRENT_CPAGE', ($page = STRUCTURE_DATA['page']) . '.php');
define('CURRENT_CONTROLLER', $page);
define('CURRENT_CNAMESPACE', $namespace = STRUCTURE_DATA['namespace'] );
define('CURRENT_CCLASS', $namespace . CURRENT_CONTROLLER);
define('CURRENT_CFPATH', str_replace
(
    CONTROLLERS_DIR, '', CURRENT_CONTROLLER) . '/' . CURRENT_CFUNCTION
);
define('CURRENT_CFURI', strtolower(CURRENT_CFPATH));
define('CURRENT_CFURL', SITE_URL . CURRENT_CFPATH);


/**
 * illustrate
 * 
 * Returns the constant value. If the constant is undefined, 
 * it defines the constant according to 
 * the specified value and returns the value.
 * 
 * @param string $const
 * @param mixed  $value = ''

 * @return mixed
 */
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

/**
 * CSRFInput
 * 
 * Generates a 32-character random key. And it transfers it to the form hidden object.
 * 
 * @param void
 * 
 * @return string
 * 
 */
function CSRFInput()
{
    Session::insert('token', ZN\CryptoGraphy\Encode\RandomPassword::create(32));

    return Form::hidden('token', Session::select('token'));
}

/**
 * length
 * 
 * It calculates the character length of the object, array and computable values.
 * 
 * @param mixed $data
 * 
 * @return int
 */
function length($data) : Int
{
    return ! is_scalar($data) ? count((array) $data) : strlen($data);
}

/**
 * headers
 * 
 * Send HTTP headers in singular or plural structure.
 * 
 * @param mixed $header
 * 
 * @return void
 */
function headers($header)
{
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

/**
 * currentUri
 * 
 * It will return the active URI information.
 * 
 * @param bool $fullPath = false
 * 
 * @return string
 * 
 */
function currentUri(Bool $fullPath = false) : String
{
    return URI::active($fullPath);
}

/**
 * getLang
 * 
 * The system returns the current language value.
 * Note: Use Lang::get() instead of this function. It can be removed in future releases.
 * 
 * @param void
 * 
 * @return string
 * 
 */
function getLang() : String
{
    return Lang::get();
}

/**
 * setLang
 * 
 * The system changes the current language value.
 * Note: Use Lang::set() instead of this function. It can be removed in future releases.
 * 
 * @param string $l = NULL
 * 
 * @return bool
 * 
 */
function setLang(String $l = NULL) : Bool
{
    return Lang::set($l);
}

/**
 * lang
 * 
 * It uses the language files in the Languages/ directory.
 * Note: Use Lang::select() instead of this function. It can be removed in future releases.
 * 
 * @param string $file    = NULL
 * @param string $str     = NULL
 * @param mixed  $changed = NULL
 */
function lang(String $file = NULL, String $str = NULL, $changed = NULL)
{
    return Lang::select($file, $str, $changed);
}

/**
 * currentLang
 * 
 * Usage is like Lang::get(). The only difference is that the use of URL 
 * language must be clear in order for this method to produce output.
 * Note: Use Lang::current() instead of this function. It can be removed in future releases.
 * 
 * @param void
 * 
 * @return string
 * 
 */
function currentLang() : String
{
    return Lang::current();
}

/**
 * currentUrl
 * 
 * Returns the active URL information.
 * Note: Use URL::current() instead of this function. It can be removed in future releases.
 * 
 * @param string $fix = NULL
 * 
 * @return string
 * 
 */
function currentUrl(String $fix = NULL) : String
{
    return URL::current($fix);
}

/**
 * siteUrl
 * 
 * Returns the system's URL information. 
 * In particular, this function is used to link the [href] property of the [a] tag.
 * Note: Use URL::site() instead of this function. It can be removed in future releases.
 * 
 */
function siteUrl(String $uri = NULL, Int $index = 0) : String
{
    return URL::site($uri, $index);
}

/**
 * siteUrls
 * 
 * Returns the system's URL information. However, the http value is output as https.
 * In particular, this function is used to link the [href] property of the [a] tag.
 * Note: Use URL::sites() instead of this function. It can be removed in future releases.
 * 
 * @param string $uri = NULL
 * 
 * @return string
 * 
 */
function siteUrls(String $uri = NULL) : String
{
    return URL::sites($uri);
}

/**
 * baseUrl
 * 
 * Returns the root URL of the system.
 * Note: Use URL::base() instead of this function. It can be removed in future releases.
 * 
 * @param string $uri = NULL
 * 
 * @return string
 */
function baseUrl(String $uri = NULL) : String
{
    return URL::base($uri);
}

/**
 * prevUrl
 * 
 * Returns the previous URL information from the active URL.
 * Note: Use URL::prev() instead of this function. It can be removed in future releases.
 * 
 * @param void
 * 
 * @return string
 */
function prevUrl() : String
{
    return URL::prev();
}

/**
 * hostUrl
 * 
 * Returns the system host information.
 * Note: Use URL::host() instead of this function. It can be removed in future releases.
 * 
 * @param string $uri = NULL
 * 
 * @return string
 * 
 */
function hostUrl(String $uri = NULL) : String
{
    return URL::host($uri);
}

/**
 * currentPath
 * 
 * Returns the active URI information.
 * Note: Use URI::current() instead of this function. It can be removed in future releases.
 * 
 * @param bool $isPath = true
 * 
 * @return string
 * 
 */
function currentPath(Bool $isPath = true) : String
{
    return URI::current($isPath);
}

/**
 * basePath
 * 
 * Returns the base URI information of the system.
 * Note: Use URI::base() instead of this function. It can be removed in future releases.
 * 
 * 
 * @param string $uri = NULL
 * 
 * @return string
 */
function basePath(String $uri = NULL) : String
{
    return URI::base($uri);
}

/**
 * prevPath
 * 
 * Returns the previous URL information from the active URL.
 * Note: Use URI::prev() instead of this function. It can be removed in future releases.
 * 
 * @param bool $isPath = true
 * 
 * @return string
 */
function prevPath(Bool $isPath = true) : String
{
    return URI::prev($isPath);
}

/**
 * redirect
 * 
 * Routes to the specified URI or URL.
 * 
 * @param string $url  = NULL
 * @param int    $time = 0
 * @param array  $data = NULL
 * @param bool   $exit = true
 * 
 * @return void
 */
function redirect(String $url = NULL, Int $time = 0, Array $data = NULL, Bool $exit = true)
{
    Redirect::location($url, $time, $data, $exit);
}

/**
 * redirectData
 * 
 * Sends data to the redirected URL address.
 * 
 * @param string $key
 * 
 * @return mixed
 */
function redirectData(String $k)
{
    return Redirect::selectData($k);
}

/**
 * redirectDeleteData
 * 
 * Used to delete the data sent to the redirection. 
 * Deletion can be done on array or string type.
 * 
 * @param mixed $data
 * 
 * @return bool
 * 
 */
function redirectDeleteData($data) : Bool
{
    return Redirect::deleteData($data);
}

/**
 * internalDefaultProjectKey
 * 
 * By default, it generates the project key. 
 * If you want to identify the key yourself. 
 * Use the following configuration file.
 * 
 * File: Config/Project.php - key:your keys
 * 
 * @param void
 * 
 * @return string
 */
function internalDefaultProjectKey()
{
    return ZN\In::defaultProjectKey();
}

/**
 * uselib
 * 
 * The single inherited library makes the call.
 * 
 * @param string $class
 * @param array  $parameters = []
 * 
 * @return mixed
 */
function uselib(String $class, Array $parameters = [])
{
    if( ! class_exists($class) )
    {
        $classInfo = Autoloader::getClassFileInfo($class);
    
        $class = $classInfo['namespace'];

        if( ! class_exists($class) )
        {
            throw new GeneralException('Error', 'classError', $class);
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

/**
 * layer
 * 
 * Loads the layer files.
 * 
 * @param string $layer
 * 
 * @return void
 * 
 */
function layer(String $layer)
{
    $path = $layer . '.php';

    import(LAYERS_DIR          . $path);
    import(EXTERNAL_LAYERS_DIR . $path);
}

/**
 * import
 * 
 * Include files once. Performance is better than require_once function.
 * 
 * @param string $file
 * 
 * @return mixed
 */
function import(String $file)
{
    $constant = 'ImportFilePrefix' . $file;

    if( ! defined($constant) )
    {
        define($constant, true);

        if( is_file($file) )
        {
            return require $file;
        }

        return false;
    }
}

/**
 * trace
 * 
 * Produces formatted output that terminates the operation.
 * 
 * @param string $message
 * 
 * @return void
 */
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

/**
 * isPhpVersion
 * 
 * Checks whether the parameter is a valid php version.
 * 
 * @param string $version = '5.2.4'
 * 
 * @return bool
 */
function isPhpVersion(String $version = '5.2.4') : Bool
{
    return IS::phpVersion($version);
}

/**
 * output
 * 
 * Produces formatted output.
 * 
 * @param mixed $data
 * @param array $settings = NULL
 * @param bool  $content  = false
 * 
 * @return mixed
 */
function output($data, Array $settings = NULL, Bool $content = false)
{
    return Output::display($data, $settings, $content);
}

/**
 * write
 * 
 * Produces the output. Data can be sent to the output.
 * 
 * @param mixed $data = NULL
 * @param array $vars = NULL
 * 
 * @param void
 */
function write($data = NULL, Array $vars = NULL)
{
    Output::write($data, $vars);
}

/**
 * writeLine
 * 
 * Produces the output and passes to the next line. 
 * Especially useful with cycling.
 * Data can be sent to the output.
 */
function writeLine($data = NULL, Array $vars = NULL, Int $brCount = 1)
{
    Output::writeLine($data, $vars, $brCount);
}

/**
 * ipv4
 * 
 * Returns the user's ip information.
 * 
 * @param void
 * 
 * @return string
 */
function ipv4() : String
{
    return User::ip();
}

/**
 * server
 * 
 * The compiled version of the $_SERVER global variable.
 * 
 * @param string $type
 * 
 * @return mixed
 */
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
            $return = htmlspecialchars($server[$type], ENT_QUOTES, "utf-8");
        }
    }
    elseif( isset($_SERVER[$type]) )
    {
        $return = htmlspecialchars($_SERVER[$type], ENT_QUOTES, "utf-8");
    }

    // 5.4.3[edited]
    return str_replace('&amp;', '&', $return) ?: false;
}

/**
 * extension
 * 
 * Returns extension information of files.
 * 
 * @param string $file
 * @param bool   $dot
 * 
 * @return string
 */
function extension(String $file, Bool $dot = false) : String
{
    return ZN\FileSystem\File\Extension::get($file, $dot);
}

/**
 * removeExtension
 * 
 * Removes path extension information.
 * 
 * @param string $file
 * 
 * @return string
 */
function removeExtension(String $file) : String
{
    return ZN\FileSystem\File\Extension::remove($file);
}

/**
 * host
 * 
 * Returns the system host information.
 * 
 * @param void
 * 
 * @return string
 */
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

/**
 * suffix 
 * 
 * It is used to append a suffix to any string.
 * 
 * @param string = NULL
 * @param string = $fix = '/'
 * 
 * @return string
 */
function suffix(String $string = NULL, String $fix = '/') : String
{
    return prefix($string, $fix, __FUNCTION__);
}

/**
 * prefix 
 * 
 * It is used to append a prefix to any string.
 * 
 * @param string = NULL
 * @param string = $fix = '/'
 * 
 * @return string
 */
function prefix(String $string = NULL, String $fix = '/', $type = __FUNCTION__) : String
{
    $stringFix = $type === 'prefix' ? $fix . $string : $string . $fix;

    if( strlen($fix) <= strlen($string) )
    {
        $prefix = $type === 'prefix' ? substr($string, 0, strlen($fix)) : substr($string, -strlen($fix));

        if( $prefix !== $fix )
        {
            $string = $stringFix;
        }
    }
    else
    {
        $string = $stringFix;
    }

    if( $string === $fix )
    {
        return false;
    }

    return $string;
}

/**
 * prefix 
 * 
 * Used to append both suffixes and prefixes to any string.
 * 
 * @param string = NULL
 * @param string = $fix = '/'
 * 
 * @return string
 */
function presuffix(String $string = NULL, String $fix = '/') : String
{
    return suffix(prefix(empty($string) ? $fix . $string . $fix : $string, $fix), $fix);
}

/**
 * internalProjectContainerDir
 * 
 * Returns the project directory name according to the project in the system.
 * Only for multi edition.
 * 
 * @param string $path = NULL
 * 
 * @return string
 */
function internalProjectContainerDir($path = NULL) : String
{
    $path = suffix($path);

    if( PROJECT_TYPE === 'SE' )
    {
        return $path;
    }

    $containers          = PROJECTS_CONFIG['containers'];
    $containerProjectDir = prefix($path, PROJECT_DIR);

    if( ! empty($containers) && defined('_CURRENT_PROJECT') )
    {
        $restoreFix = 'Restore';

        // 5.3.8[added]
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

/**
 * internalCurrentProject
 * 
 * It arranges some values according to the project which is valid in the system.
 * 
 * @param void
 * 
 * @return mixed
 */
function internalCurrentProject()
{
    internalIsWritable('.htaccess');

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
 * internalIsWritable
 * 
 * Controls whether file permission is required in the operating system where the system is installed.
 * 
 * @param string $path
 * 
 * @return void
 */
function internalIsWritable(String $path)
{
    if( is_file($path) && ! is_writable($path) && IS::software() === 'apache' )
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
