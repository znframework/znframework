<?php namespace ZN\CryptoGraphy\Encode;

use ZN\CryptoGraphy\EncodeCommon;
use ZN\CryptoGraphy\Exception\InvalidArgumentException;

class Type extends EncodeCommon implements TypeInterface
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
    // Type
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(String $data, String $type = 'md5') : String
    {
        $algos = ['golden', 'super'];

        if( ! isHash($type) && ! in_array($type, $algos) )
        {
            throw new InvalidArgumentException('Error', 'hashParameter', 'String $type');
        }

        if( in_array($type, $algos) )
        {
            return $this->$type($data);
        }

        return hash($type, $data);
    }
}
