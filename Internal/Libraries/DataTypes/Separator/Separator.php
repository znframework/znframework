<?php namespace ZN\DataTypes;

use CallController;

class InternalSeparator extends CallController implements SeparatorInterface
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
    // Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $data
    // @param string $key
    // @param string $separator
    //
    //--------------------------------------------------------------------------------------------------------
    public function encode(Array $data, String $key = NULL, String $separator = NULL) : String
    {
        return SeparatorFactory::class('EncodeData')->do($data, $key, $separator);
    }

    //--------------------------------------------------------------------------------------------------------
    // Decode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $word
    // @param string $key
    // @param string $separator
    //
    //--------------------------------------------------------------------------------------------------------
    public function decode(String $word, String $key = NULL, String $separator = NULL) : \stdClass
    {
        return SeparatorFactory::class('DecodeData')->do($word, $key, $separator);
    }

    //--------------------------------------------------------------------------------------------------------
    // Decode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $word
    // @param string $key
    // @param string $separator
    //
    //--------------------------------------------------------------------------------------------------------
    public function decodeObject(String $word, String $key = NULL, String $separator = NULL) : \stdClass
    {
        return $this->decode($word, $key, $separator);
    }

    //--------------------------------------------------------------------------------------------------------
    // Decode Array
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $word
    // @param string $key
    // @param string $separator
    //
    //--------------------------------------------------------------------------------------------------------
    public function decodeArray(String $word, String $key = NULL, String $separator = NULL) : Array
    {
        return (array) $this->decode($word, $key, $separator);
    }
}
