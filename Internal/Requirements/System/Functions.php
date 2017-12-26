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

/**
 * illustrate
 * 
 * Returns the constant value. If the constant is undefined, 
 * it defines the constant according to 
 * the specified value and returns the value.
 * 
 * @param string $const
 * @param mixed  $value = ''
 *
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