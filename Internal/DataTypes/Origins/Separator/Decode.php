<?php namespace ZN\DataTypes\Separator;

use stdClass;

class Decode extends SeparatorExtends
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

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
