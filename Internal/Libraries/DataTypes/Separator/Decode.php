<?php namespace ZN\DataTypes\Separator;

class Decode extends SeparatorExtends implements DecodeInterface
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

    //--------------------------------------------------------------------------------------------------------
    // Object
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $word
    // @param string $key
    // @param string $separator
    //
    //--------------------------------------------------------------------------------------------------------
    public function object(String $word, String $key = NULL, String $separator = NULL) : \stdClass
    {
        return $this->do($word, $key, $separator);
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
    public function array(String $word, String $key = NULL, String $separator = NULL) : Array
    {
        return (array) $this->do($word, $key, $separator);
    }
}
