<?php namespace ZN\DataTypes\Separator;

use ZN\DataTypes\SeparatorCommon;

class DecodeData extends SeparatorCommon
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
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
    public function do(String $word, String $key = NULL, String $separator = NULL) : \stdClass
    {
        if( empty($key) )
        {
            $key = $this->key;
        }

        if( empty($separator) )
        {
            $separator = $this->separator;
        }

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
}
