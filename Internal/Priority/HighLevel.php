<?php
//--------------------------------------------------------------------------------------------------
// High Level
//--------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// EOL
//--------------------------------------------------------------------------------------------------
//
// @return \r\n
//
//--------------------------------------------------------------------------------------------------
define('EOL', PHP_EOL);

//--------------------------------------------------------------------------------------------------
// CRLF
//--------------------------------------------------------------------------------------------------
//
// @return \r\n
//
//--------------------------------------------------------------------------------------------------
define('CRLF', "\r\n");

//--------------------------------------------------------------------------------------------------
// CR
//--------------------------------------------------------------------------------------------------
//
// @return \r
//
//--------------------------------------------------------------------------------------------------
define('CR', "\r");

//--------------------------------------------------------------------------------------------------
// LF
//--------------------------------------------------------------------------------------------------
//
// @return \n
//
//--------------------------------------------------------------------------------------------------
define('LF', "\n");

//--------------------------------------------------------------------------------------------------
// LF
//--------------------------------------------------------------------------------------------------
//
// @return \t
//
//--------------------------------------------------------------------------------------------------
define('HT', "\t");

//--------------------------------------------------------------------------------------------------
// TAB
//--------------------------------------------------------------------------------------------------
//
// @return \t
//
//--------------------------------------------------------------------------------------------------
define('TAB', "\t");

//--------------------------------------------------------------------------------------------------
// FF
//--------------------------------------------------------------------------------------------------
//
// @return \f
//
//--------------------------------------------------------------------------------------------------
define('FF', "\f");

//--------------------------------------------------------------------------------------------------
// PROJECTS_CONFIG
//--------------------------------------------------------------------------------------------------
//
// @return Projects/Projects.php
//
//--------------------------------------------------------------------------------------------------
define('PROJECTS_CONFIG', import(PROJECTS_DIR . 'Projects.php'));

//--------------------------------------------------------------------------------------------------
// DEFAULT_PROJECT
//--------------------------------------------------------------------------------------------------
//
// @return Frontend/
//
//--------------------------------------------------------------------------------------------------
define('DEFAULT_PROJECT', PROJECTS_CONFIG['directory']['default']);

//--------------------------------------------------------------------------------------------------
// EXTERNAL_CONFIG_DIR
//--------------------------------------------------------------------------------------------------
//
// @return External/Config/
//
//--------------------------------------------------------------------------------------------------
define('EXTERNAL_CONFIG_DIR', EXTERNAL_DIR . 'Config'.DS);

//--------------------------------------------------------------------------------------------------
// INTERNAL_CONFIG_DIR
//--------------------------------------------------------------------------------------------------
//
// @return Internal/Config/
//
//--------------------------------------------------------------------------------------------------
define('INTERNAL_CONFIG_DIR', INTERNAL_DIR . 'Config'.DS);

//--------------------------------------------------------------------------------------------------
// REQUIRED_FILE
//--------------------------------------------------------------------------------------------------
//
// @return Internal/Core/Required.php
//
//--------------------------------------------------------------------------------------------------
define('REQUIRED_FILE', CORE_DIR . 'Required.php');

//--------------------------------------------------------------------------------------------------
// Current Project
//--------------------------------------------------------------------------------------------------
//
// @param void
//
//--------------------------------------------------------------------------------------------------
internalCurrentProject();

//--------------------------------------------------------------------------------------------------
// isImport()
//--------------------------------------------------------------------------------------------------
//
// @param string $path
//
// @return Bool
//
//--------------------------------------------------------------------------------------------------
function isImport(String $path) : Bool
{
    return in_array( realpath(suffix($path, '.php')), get_required_files() );
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
    return preg_match('#^(\w+:)?//#i', $url);
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
    return preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email);
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
    return is_scalar($str);
}

//--------------------------------------------------------------------------------------------------
// isRealNumeric()
//--------------------------------------------------------------------------------------------------
//
// @param numeric $num = 0
//
// @return Bool
//
//--------------------------------------------------------------------------------------------------
function isRealNumeric($num = 0) : Bool
{
    return ! is_string($num) && is_numeric($num);
}

//--------------------------------------------------------------------------------------------------
// isDeclaredClass()
//--------------------------------------------------------------------------------------------------
//
// @param string $class
//
// @return Bool
//
//--------------------------------------------------------------------------------------------------
function isDeclaredClass(String $class) : Bool
{
    return in_array(strtolower($class), array_map('strtolower', get_declared_classes()));
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
    $hashAlgos = Arrays::addLast(hash_algos(), ['super', 'golden']);

    return in_array($type, $hashAlgos);
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
    return array_search(strtolower($charset), array_map('strtolower', mb_list_encodings()), true);
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
    return ! empty($array) && is_array($array);
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
    $var = $var ?? $value;
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
    $var = $var === false ? $value : $var;
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
    $var = empty($var) ? $value : $var;
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
    // ---------------------------------------------------------------------------------------------
    // AYARLAR
    // ---------------------------------------------------------------------------------------------
    $textType = $settings['textType'] ?? 'monospace, Tahoma, Arial';
    $textSize = $settings['textSize'] ?? '12px';
    // ---------------------------------------------------------------------------------------------

    $globalStyle = ' style="font-family:'.$textType.'; font-size:'.$textSize .';"';

    $output  = "<span$globalStyle>";
    $output .= internalOutput($data, '', 0, (array) $settings);
    $output .= "</span>";

    if( $content === false)
    {
        echo $output;
    }
    else
    {
        return $output;
    }
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
function write(String $data = NULL, Array $vars = NULL)
{
    if( ! is_scalar($data) )
    {
        echo 'Not String!'; return false;
    }

    if( ! empty($data) && is_array($vars) )
    {
        $varsArray = [];

        foreach( $vars as $k => $v )
        {
            $varsArray['{'.$k.'}']  = $v;
        }

        $data = str_replace(array_keys($varsArray), array_values($varsArray), $data);
    }

    echo $data;
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
function writeLine(String $data = NULL, Array $vars = NULL, Int $brCount = 1)
{
    echo write($data, $vars) . str_repeat('<br>', $brCount);
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
    $localIP = '127.0.0.1';

    if( isset($_SERVER['HTTP_CLIENT_IP']) )
    {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif( isset($_SERVER['HTTP_X_FORWARDED_FOR']) )
    {
        $ip = divide($_SERVER['HTTP_X_FORWARDED_FOR'], ',');
    }
    else
    {
        $ip = $_SERVER['REMOTE_ADDR'] ?? $localIP;
    }

    if( $ip === '::1')
    {
        $ip = $localIP;
    }

    return $ip;
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
    $pathInfo = pathinfo($file);

    return $pathInfo[$info] ?? false;
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
    $dote = $dote === true ? '.' : '';

    return $dote . strtolower(pathInfos($file, "extension"));
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
    return preg_replace('/\\.[^.\\s]{3,4}$/', '', $file);
}

//--------------------------------------------------------------------------------------------------
// isSubdomain() -> 4.4.1
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function isSubdomain()
{
    return (bool) (PROJECTS_CONFIG['directory']['others'][host()] ?? false);
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
// Objects
//--------------------------------------------------------------------------------------------------
//
// @param array $array
//
// @return object
//
//--------------------------------------------------------------------------------------------------
function objects(Array $array) : stdClass
{
    $object = new stdClass;

    return internalObjects($array, $object);
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
// EOL
//--------------------------------------------------------------------------------------------------
//
// @param int $repeat = 1
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function eol(Int $repeat = 1) : String
{
    return str_repeat(EOL, $repeat);
}

//--------------------------------------------------------------------------------------------------
// getOS()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function getOS() : String
{
    if( stristr(PHP_OS, 'WIN') )
    {
        return 'WIN';
    }
    elseif( stristr(PHP_OS, 'MAC') )
    {
        return 'MAC';
    }
    elseif( stristr(PHP_OS, 'LINUX') )
    {
        return 'LINUX';
    }
    elseif( stristr(PHP_OS, 'UNIX') )
    {
        return 'UNIX';
    }
    else
    {
        return 'UNKNOWN';
    }
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
// divide()
//--------------------------------------------------------------------------------------------------
//
// @param string $str
// @param string $separator = '|'
// @param scalar $index     = 0
//
// @return mixed
//
//--------------------------------------------------------------------------------------------------
function divide(String $str = NULL, String $separator = '|', String $index = '0')
{
    $arrayEx = explode($separator, $str);

    if( $index === 'all' )
    {
        return $arrayEx;
    }

    if( $index < 0 )
    {
        $ind = (count($arrayEx) + ($index));
    }
    elseif( $index === 'last' )
    {
        $ind = (count($arrayEx) - 1);
    }
    elseif( $index === 'first' )
    {
        $ind = 0;
    }
    else
    {
        $ind = $index;
    }

    return $arrayEx[$ind] ?? false;
}

//--------------------------------------------------------------------------------------------------
// lastError()
//--------------------------------------------------------------------------------------------------
//
// @param string $type = NULL
//
// @param mixed
//
//--------------------------------------------------------------------------------------------------
function lastError(String $type = NULL)
{
    $result = error_get_last();

    if( $type === NULL )
    {
        return $result;
    }
    else
    {
        return $result[$type] ?? false;
    }
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
    $path                = suffix($path, DS);
    $containers          = PROJECTS_CONFIG['containers'];
    $containerProjectDir = PROJECT_DIR . $path;

    if( ! empty($containers) && defined('_CURRENT_PROJECT') )
    {
        return ! empty($containers[_CURRENT_PROJECT]) && ! file_exists($containerProjectDir)
               ? PROJECTS_DIR . suffix($containers[_CURRENT_PROJECT], DS) . $path
               : $containerProjectDir;
    }

    return $containerProjectDir;
}

//--------------------------------------------------------------------------------------------------
// Project Mode
//--------------------------------------------------------------------------------------------------
//
// @param string $mode: publication, development, restoration
// @param int    $report: -1
//
// @return void
//
//--------------------------------------------------------------------------------------------------
function internalProjectMode(String $mode, Int $report = -1)
{
    //----------------------------------------------------------------------------------------------
    // Kullanılabilir Uygulama Seçenekleri
    //----------------------------------------------------------------------------------------------
    switch( strtolower($mode) )
    {
        //------------------------------------------------------------------------------------------
        // Publication Yayın Modu
        // Tüm hatalar kapalıdır.
        // Projenin tamamlanmasından sonra bu modun kullanılması önerilir.
        //------------------------------------------------------------------------------------------
        case 'publication' :
            error_reporting(0);
        break;
        //------------------------------------------------------------------------------------------

        //------------------------------------------------------------------------------------------
        // Restoration Onarım Modu
        // Hataların görünümü görecelidir.
        //------------------------------------------------------------------------------------------
        case 'restoration' :
        //------------------------------------------------------------------------------------------
        // Development Geliştirme Modu
        // Tüm hatalar açıktır.
        //------------------------------------------------------------------------------------------
        case 'development' :
            error_reporting($report);
        break;
        //------------------------------------------------------------------------------------------

        //------------------------------------------------------------------------------------------
        // Farklı bir kullanım hatası
        //------------------------------------------------------------------------------------------
        default: trace('Invalid Application Mode! Available Options: ["development"], ["restoration"] or ["publication"]');
        //------------------------------------------------------------------------------------------
    }
    //----------------------------------------------------------------------------------------------
}

//--------------------------------------------------------------------------------------------------
// internalOutput()
//--------------------------------------------------------------------------------------------------
//
// @param mixed  $data
// @param string $tab      = ''
// @param int    $start    = 0
// @param array  $settings = []
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function internalOutput($data, String $tab = NULL, Int $start = 0, Array $settings = []) : String
{
    static $start;

    $lengthColor    = $settings['lengthColor']  ?? 'grey';
    $keyColor       = $settings['keyColor']     ?? '#000';
    $typeColor      = $settings['typeColor']    ?? '#8C2300';
    $stringColor    = $settings['stringColor']  ?? 'red';
    $numericColor   = $settings['numericColor'] ?? 'green';

    $output = '';
    $eof    = '<br>';
    $tab    = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $start);

    $lengthstyle = ' style="color:'.$lengthColor.'"';
    $keystyle    = ' style="color:'.$keyColor.'"';
    $typestyle   = ' style="color:'.$typeColor.'"';

    $vartype = 'array';

    if( is_object($data) )
    {
        $data = (array) $data;
        $vartype = 'object';
    }

    if( ! is_array($data) )
    {
        return $data.$eof;
    }
    else
    {
        foreach( $data as $k => $v )
        {
            if( is_object($v) )
            {
                $v = (array) $v;
                $vartype = 'object';
            }

            if( ! is_array($v) )
            {
                $valstyle  = ' style="color:'.$numericColor.';"';

                $type = gettype($v);

                if( $type === 'string' )
                {
                    $v = "'".$v."'";
                    $valstyle = ' style="color:'.$stringColor.';"';

                    $type = 'string';
                }
                elseif( $type === 'boolean' )
                {
                    $v = ( $v === true ) ? 'true' : 'false';

                    $type = 'boolean';
                }

                $output .= "$tab<span$keystyle>$k</span> => <span$typestyle>$type</span> <span$valstyle>$v</span> <span$lengthstyle>( length = ".strlen($v)." )</span>$eof";
            }
            else
            {
                $output .= "$tab<span$keystyle>$k</span> => <span$typestyle>$vartype</span> $eof $tab( $eof ".internalOutput($v, $tab, (int) $start++)." $tab) ".$eof;
                $start--;
            }
        }
    }

    return $output;
}

//--------------------------------------------------------------------------------------------------
// Internal Objects
//--------------------------------------------------------------------------------------------------
//
// @param array    $array
// @param stdClass $obj
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function internalObjects(Array $array, stdClass &$std) : stdClass
{
    foreach( $array as $key => $value )
    {
        if( is_array($value) )
        {
            $std->$key = new stdClass;

            internalObjects($value, $std->$key);
        }
        else
        {
            $std->$key = $value;
        }
    }

    return $std;
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
    $projectConfig = PROJECTS_CONFIG['directory']['others'];
    $projectDir    = $projectConfig;

    if( defined('CONSOLE_PROJECT_NAME') )
    {
        $internalDir = CONSOLE_PROJECT_NAME;
    }
    else
    {
        $currentPath   = server('currentPath');
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
