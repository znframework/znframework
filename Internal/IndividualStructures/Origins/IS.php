<?php namespace ZN\IndividualStructures;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\DataTypes\Strings;
use ZN\DataTypes\Arrays;

class IS implements ISInterface
{
    protected static $dataTypes = ['cookie', 'session', 'get', 'post', 'env', 'server'];

    //--------------------------------------------------------------------------------------------------
    // Magig Call -> 5.3.11 - 5.3.2[edited]
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------
    public function __call($method, $parameters)
    {
        if( function_exists($ctype = 'ctype_' . $method) )
        {
            return $ctype((string) $parameters[0]);
        }

        // 5.3.2[edited]
        if( in_array($method, self::$dataTypes) )
        {
            return \Filters::$method($parameters[0]);
        }

        $methods = Strings\Split::upperCase($realMethod = $method);
        $method  = implode('_', Arrays\Casing::lower($methods));
        $method  = 'is_' . $method;

        if( ! function_exists($method) )
        {
            Support::classMethod(__CLASS__, $realMethod);
        }

        return $method(...$parameters);
    }

    //--------------------------------------------------------------------------------------------------
    // software() -> 5.4.75
    //--------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------
    public static function software() : String
    {
        return strtolower(explode('/', $_SERVER['SERVER_SOFTWARE'] ?? 'apache')[0]);
    }

    //--------------------------------------------------------------------------------------------------
    // timeZone() -> 5.2.6
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $timezone
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    public static function timeZone(String $timezone) : Bool
    {
        return in_array($timezone, timezone_identifiers_list());
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
    public static function phpVersion(String $version = '5.2.4')
    {
        return (bool) version_compare(PHP_VERSION, $version, '>=');
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
    public static function import(String $path) : Bool
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
    public static function url(String $url) : Bool
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
    public static function email(String $email) : Bool
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
    public static function char($str) : Bool
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
    public static function realNumeric($num = 0) : Bool
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
    public static function declaredClass(String $class) : Bool
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
    public static function hash(String $type) : Bool
    {
        $hashAlgos = array_merge(hash_algos(), ['super', 'golden']);

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
    public static function charset(String $charset) : Bool
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
    public static function array($array) : Bool
    {
        return ! empty($array) && is_array($array);
    }
}
