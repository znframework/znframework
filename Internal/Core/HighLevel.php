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
// EXTERNAL_CONFIG_DIR
//--------------------------------------------------------------------------------------------------
//
// @return External/Config/
//
//--------------------------------------------------------------------------------------------------
define('EXTERNAL_CONFIG_DIR', EXTERNAL_DIR.'Config'.DS);

//--------------------------------------------------------------------------------------------------
// INTERNAL_CONFIG_DIR
//--------------------------------------------------------------------------------------------------
//
// @return Internal/Config/
//
//--------------------------------------------------------------------------------------------------
define('INTERNAL_CONFIG_DIR', INTERNAL_DIR.'Config'.DS);

//--------------------------------------------------------------------------------------------------
// REQUIRED_FILE
//--------------------------------------------------------------------------------------------------
//
// @return Internal/Core/Required.php
//
//--------------------------------------------------------------------------------------------------
define('REQUIRED_FILE', CORE_DIR.'Required.php');

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
// FF
//--------------------------------------------------------------------------------------------------
//
// @return \f
//
//--------------------------------------------------------------------------------------------------
define('FF', "\f");

//--------------------------------------------------------------------------------------------------
// _CURRENT_PROJECT
//--------------------------------------------------------------------------------------------------
//
// @return _CURRENT_PROJECT
//
//--------------------------------------------------------------------------------------------------
$currentPath = server('currentPath');

$internalDir = ( ! empty($currentPath) ? explode('/', ltrim($currentPath, '/'))[0] : '');

$othersapp = PROJECTS_CONFIG['directory']['others'];

if( is_array($othersapp) )
{
    $internalDir = ! empty($othersapp[$internalDir]) ? $othersapp[$internalDir] : $internalDir;
}

if( ! empty($internalDir) && is_dir(PROJECTS_DIR.$internalDir) )
{
    define('_CURRENT_PROJECT', $internalDir);
}

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
    if( in_array( realpath(suffix($path, '.php')), get_required_files() ) )
    {
        return true;
    }
    else
    {
        return false;
    }
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
    if( ! preg_match('#^(\w+:)?//#i', $url) )
    {
        return false;
    }
    else
    {
        return true;
    }
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
    if( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email) )
    {
        return false;
    }
    else
    {
        return true;
    }
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
    if( is_scalar($str) )
    {
        return true;
    }
    else
    {
        return false;
    }
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
    if( ! is_string($num) && is_numeric($num) )
    {
        return true;
    }
    else
    {
        return false;
    }
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
    if( in_array(strtolower($class), array_map('strtolower', get_declared_classes())) )
    {
        return true;
    }
    else
    {
        return false;
    }
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
    if( in_array($type, hash_algos()) )
    {
        return true;
    }
    else
    {
        return false;
    }
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
    if( array_search(strtolower($charset), array_map('strtolower', mb_list_encodings()), true) )
    {
        return true;
    }
    else
    {
        return false;
    }
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
    if( ! empty($array) && is_array($array) )
    {
        return true;
    }
    else
    {
        return false;
    }
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
    $var = $var === NULL ? $value : $var;
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
function output($data, Array $settings = [], Bool $content = false)
{
    // ---------------------------------------------------------------------------------------------
    // AYARLAR
    // ---------------------------------------------------------------------------------------------
    $textType       = isset($settings['textType'])      ? $settings['textType']     : 'monospace, Tahoma, Arial';
    $textSize       = isset($settings['textSize'])      ? $settings['textSize']     : '12px';
    // ---------------------------------------------------------------------------------------------

    $globalStyle  = ' style="font-family:'.$textType.'; font-size:'.$textSize .';"';

    $output  = "<span$globalStyle>";
    $output .= internalOutput($data, '', 0, $settings);
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
function write(String $data, Array $vars = [])
{
    if( ! is_scalar($data) )
    {
        echo 'Not String!';
        return false;
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
function writeLine(String $data, Array $vars = [], Int $brCount = 1)
{
    echo write($data, $vars).str_repeat("<br>", $brCount);
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
function suffix(String $string, String $fix = '/') : String
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
function prefix(String $string, String $fix = '/') : String
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
function presuffix(String $string, String $fix = '/') : String
{
    return suffix(prefix($string, $fix), $fix);
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
        $host = $_SERVER['HTTP_X_FORWARDED_HOST'];

        $elements = explode(',', $host);

        $host = trim(end($elements));
    }
    else
    {
        if( isset($_SERVER['HTTP_HOST']) )
        {
            $host = $_SERVER['HTTP_HOST'];
        }
        else
        {
            if( isset($_SERVER['SERVER_NAME']) )
            {
                $host = $_SERVER['SERVER_NAME'];
            }
            else
            {
                $host = ! empty($_SERVER['SERVER_ADDR'])
                        ? $_SERVER['SERVER_ADDR']
                        : '';
            }
        }
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

    if( isset($pathInfo[$info]) )
    {
        return $pathInfo[$info];
    }
    else
    {
        return false;
    }
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
    $dote = $dote === true
          ? '.'
          : '';

    return $dote.strtolower(pathInfos($file, "extension"));
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
function divide(String $str, String $separator = '|', String $index = '0')
{
    $arrayEx = explode($separator, $str);

    if( $index === 'all' )
    {
        return $arrayEx;
    }

    if( $index < 0 )
    {
        $ind = (count($arrayEx)+($index));
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

    if( isset($arrayEx[$ind]) )
    {
        return $arrayEx[$ind];
    }
    else
    {
        return false;
    }
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
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    if( $ip === '::1')
    {
        $ip = '127.0.0.1';
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
function server(String $type = '')
{
    $server =
    [
        ''                           => $_SERVER,
        'name'                       => $_SERVER['SERVER_NAME']           ?? false,
        'admin'                      => $_SERVER['SERVER_ADMIN']          ?? false,
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
        if( isset($result[$type]) )
        {
            return $result[$type];
        }
        else
        {
            return false;
        }
    }
}

//--------------------------------------------------------------------------------------------------
// internalApplicationContainerDir()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @param string
//
//--------------------------------------------------------------------------------------------------
function internalApplicationContainerDir() : String
{
    $containers = PROJECTS_CONFIG['containers'];

    if( ! empty($containers) && defined('_CURRENT_PROJECT') )
    {
        return ! empty($containers[_CURRENT_PROJECT])
               ? PROJECTS_DIR.suffix($containers[_CURRENT_PROJECT])
               : PROJECT_DIR;
    }

    return PROJECT_DIR;
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
function internalOutput($data, String $tab = '', Int $start = 0, Array $settings = []) : String
{
    static $start;

    $lengthColor    = isset($settings['lengthColor'])   ? $settings['lengthColor']  : 'grey';
    $keyColor       = isset($settings['keyColor'])      ? $settings['keyColor']     : '#000';
    $typeColor      = isset($settings['typeColor'])     ? $settings['typeColor']    : '#8C2300';
    $stringColor    = isset($settings['stringColor'])   ? $settings['stringColor']  : 'red';
    $numericColor   = isset($settings['numericColor'])  ? $settings['numericColor'] : 'green';

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

                $output .= "$tab<span$keystyle>$k</span> => <span$typestyle>$type</span> <span$valstyle>$v</span> <span$lengthstyle>( length = ".strlen($v)." )</span>,$eof";
            }
            else
            {
                $output .= "$tab<span$keystyle>$k</span> => <span$typestyle>$vartype</span> $eof $tab( $eof ".internalOutput($v, $tab, (int) $start++)." $tab), ".$eof;
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
