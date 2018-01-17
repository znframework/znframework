<?php namespace ZN\Request;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Lang;
use ZN\Request;
use ZN\DataTypes\Arrays;
use ZN\Ability\Singleton;
use ZN\Request\Exception\InvalidArgumentException;

class Http implements HttpInterface
{
    use Singleton;

    //--------------------------------------------------------------------------------------------------------
    // Settings
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected static $settings;

    //--------------------------------------------------------------------------------------------------------
    // Types
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected static $types =
    [
        'post',
        'get',
        'env',
        'server',
        'request'
    ];

    //--------------------------------------------------------------------------------------------------------
    // Http
    //--------------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Http mesaj listesi yer alır.
    //
    //--------------------------------------------------------------------------------------------------------
    protected static $messages =
    [
        //1XX Information
        '100|continue'              => '100 Continue',
        '101|switchProtocols'       => '101 Switching Protocols',
        '103|checkpoint'            => '103 Checkpoint',

        //2XX Successful
        '200|ok'                    => '200 OK',
        '201|created'               => '201 Created',
        '202|accepted'              => '202 Accepted',
        '203|nonAuthInfo'           => '203 Non-Authoritative Information',
        '204|noContent'             => '204 No Content',
        '205|resetContent'          => '205 Reset Content',
        '206|partialContent'        => '206 Partial Content',

        // 3XX Redirection
        '300|multipleChoices'       => '300 Multiple Choices',
        '301|movedPermanent'        => '301 Moved Permanently',
        '302|found'                 => '301 Found',
        '303|seeOther'              => '303 See Other',
        '304|notModified'           => '304 Not Modified',
        '306|switchProxy'           => '306 Switch Proxy',
        '307|temporaryRedirect'     => '307 Temporary Redirect',
        '308|resumeIncomplete'      => '308 Resume Incomplete',

        // 4XX Client Error
        '400|badRequest'            => '400 Bad Request',
        '401|unauth'                => '401 Unauthorized',
        '402|paymentRequired'       => '402 Payment Required',
        '403|forbidden'             => '403 Forbidden',
        '404|notFound'              => '404 Not Found',
        '405|methodNotAllowed'      => '405 Method Not Allowed',
        '406|notAccept'             => '406 Not Acceptable',
        '407|proxyAuth'             => '407 Proxy Authentication Required',
        '408|requestTimeout'        => '408 Request Timeout',
        '409|conflict'              => '409 Conflict',
        '410|gone'                  => '410 Gone',
        '411|lengthRequired'        => '411 Length Required',
        '412|preconditionFailed'    => '412 Precondition Failed',
        '413|requestEntity'         => '413 Request Entity Too Large',
        '414|requestUri'            => '414 Request-URI Too Long',
        '415|unsupportedMedia'      => '415 Unsupported Media Type',
        '416|requestedRange'        => '416 Requested Range Not Satisfiable',
        '417|expectFailed'          => '417 Expectation Failed',

        // 5XX Server Error
        '500|internalServerError'   => '500 Internal Server Error',
        '501|notImplement'          => '501 Not Implemented',
        '502|badGateway'            => '502 Bad Gateway',
        '503|serviceUnavailable'    => '503 Service Unavailable',
        '504|gatewayTimeout'        => '504 Gateway Timeout',
        '505|versionNotSupported'   => '505 HTTP Version Not Supported',
        '511|authRequired'          => '511 Network Authentication Required'
    ];

    //--------------------------------------------------------------------------------------------------
    // httpFix() -> 5.1.0
    //--------------------------------------------------------------------------------------------------
    //
    // @param bool $security = false
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------
    public static function fix(Bool $security = false) : String
    {
        return ( $security === false )
               ? 'http://'
               : 'https://';
    }

    //--------------------------------------------------------------------------------------------------------
    // Host -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function host() : String
    {
        return Server::data('host');
    }

    //--------------------------------------------------------------------------------------------------------
    // User Agent -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function userAgent() : String
    {
        return Server::data('userAgent');
    }

    //--------------------------------------------------------------------------------------------------------
    // Accept -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function accept() : String
    {
        return Server::data('accept');
    }

    //--------------------------------------------------------------------------------------------------------
    // Accept Language -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function language() : String
    {
        return Server::data('acceptLanguage');
    }

    //--------------------------------------------------------------------------------------------------------
    // Accept Encoding -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function encoding() : String
    {
        return Server::data('acceptEncoding');
    }

    //--------------------------------------------------------------------------------------------------------
    // Cookie -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function cookie() : String
    {
        return Server::data('cookie');
    }

    //--------------------------------------------------------------------------------------------------------
    // Connection -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function connection() : String
    {
        return Server::data('connection');
    }

    /**
     * Request method type
     * 
     * @param string ...$methods
     * 
     * @returm bool
     */
    public static function isRequestMethod(...$methods) : Bool
    {
        return Request::isMethod();
    }

    /**
     * Request is ajax
     * 
     * @param bool
     */
    public static function isAjax() : Bool
    {
        return Request::isAjax();
    }

    /**
     * Request CURL
     * 
     * @return bool
     */
    public static function isCurl() : Bool
    {
        return Request::isCurl();
    }

    //--------------------------------------------------------------------------------------------------------
    // Browser Lang
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $default tr
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function browserLang(String $default = 'en') : String
    {
        $languages = Lang::shortCodes();

        $lang = strtolower(substr(($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? $default), 0, 2));

        if( isset($languages[$lang]) )
        {
            return strtolower($lang);
        }

        return $default;
    }

    //--------------------------------------------------------------------------------------------------------
    // Code
    //--------------------------------------------------------------------------------------------------------
    //
    // @param numeric $code
    //
    //--------------------------------------------------------------------------------------------------------
    public static function code($code = 200) : String
    {
        $messages = Arrays::multikey(self::$messages);

        if( isset($messages[$code]) )
        {
            return $messages[$code];
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------------
    // Message
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $message
    //
    //--------------------------------------------------------------------------------------------------------
    public static function message(String $message) : String
    {
        return self::code($message);
    }

    //--------------------------------------------------------------------------------------------------------
    // Name
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    //
    //--------------------------------------------------------------------------------------------------------
    public static function name(String $name) : Http
    {
        self::$settings['name'] = $name;

        return self::singleton();
    }

    //--------------------------------------------------------------------------------------------------------
    // Value
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $value
    //
    //--------------------------------------------------------------------------------------------------------
    public static function value($value) : Http
    {
        self::$settings['value'] = $value;

        return self::singleton();
    }

    //--------------------------------------------------------------------------------------------------------
    // Input
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $input
    //
    //--------------------------------------------------------------------------------------------------------
    public static function input(String $input) : Http
    {
        if( in_array($input, self::$types) )
        {
            self::$settings['input'] = $input;
        }
        else
        {
            throw new InvalidArgumentException('Error', 'invalidInput', $input.' : get, post, server, env, request');
        }

        return self::singleton();
    }

    //--------------------------------------------------------------------------------------------------------
    // Select
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    //
    //--------------------------------------------------------------------------------------------------------
    public static function select(String $name = NULL)
    {
        $name  = self::$settings['name']  ?? $name;
        $input = self::$settings['input'] ?? false;

        self::$settings = [];

        return Method::$input($name);
    }

    //--------------------------------------------------------------------------------------------------------
    // Insert
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $value
    //
    //--------------------------------------------------------------------------------------------------------
    public static function insert(String $name = NULL, $value = NULL) : Bool
    {
        $name  = self::$settings['name']  ?? $name;
        $input = self::$settings['input'] ?? false;
        $value = self::$settings['value'] ?? $value;

        self::$settings = [];

        return Method::$input($name, $value);
    }

    //--------------------------------------------------------------------------------------------------------
    // Delete
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    //
    //--------------------------------------------------------------------------------------------------------
    public static function delete(String $name = NULL) : Bool
    {
        $name  = self::$settings['name']  ?? $name;
        $input = self::$settings['input'] ?? false;

        self::$settings = [];

        switch( $input )
        {
            case 'post'    : unset($_POST[$name]);    break;
            case 'get'     : unset($_GET[$name]);     break;
            case 'env'     : unset($_ENV[$name]);     break;
            case 'server'  : unset($_SERVER[$name]);  break;
            case 'request' : unset($_REQUEST[$name]); break;
        }

        return true;
    }
}