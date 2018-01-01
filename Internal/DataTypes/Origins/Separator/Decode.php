<?php namespace ZN\DataTypes\Separator;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use stdClass;

class Decode extends SeparatorExtends
{
    //--------------------------------------------------------------------------------------------------------
    // Do
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $word
    // @param string $key
    // @param string $separator
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do(String $word, String $key = NULL, String $separator = NULL) : stdClass
    {
        $key       = $key       ?: self::$key;
        $separator = $separator ?: self::$separator;

        $keyval = explode($separator, $word);
        $splits = [];
        $object = [];

        if( is_array($keyval) ) foreach( $keyval as $v )
        {
             $splits = explode($key, $v);

             if( isset($splits[1]) )
             {
                $object[$splits[0]] = $splits[1];
             }
        }

        return (object) $object;
    }

    //--------------------------------------------------------------------------------------------------------
    // Object
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $word
    // @param string $key
    // @param string $separator
    //
    //--------------------------------------------------------------------------------------------------------
    public static function object(String $word, String $key = NULL, String $separator = NULL) : stdClass
    {
        return self::do($word, $key, $separator);
    }

    //--------------------------------------------------------------------------------------------------------
    // Array
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $word
    // @param string $key
    // @param string $separator
    //
    //--------------------------------------------------------------------------------------------------------
    public static function array(String $word, String $key = NULL, String $separator = NULL) : Array
    {
        return (array) self::do($word, $key, $separator);
    }
}
