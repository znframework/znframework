<?php namespace ZN\DataTypes\Separator;

class Encode extends SeparatorExtends
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
    // @param array  $data
    // @param string $key
    // @param string $separator
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do(Array $data, String $key = NULL, String $separator = NULL) : String
    {
        $word      = NULL;
        $key       = $key       ?: self::$key;
        $separator = $separator ?: self::$separator;
 
        foreach( $data as $k => $v )
        {
            $word .= self::_security($k).$key.self::_security($v).$separator;
        }

        return mb_substr($word, 0, -(mb_strlen($separator)));
    }
}
