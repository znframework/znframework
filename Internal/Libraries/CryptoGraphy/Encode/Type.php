<?php namespace ZN\CryptoGraphy\Encode;

use Encode;
use ZN\CryptoGraphy\Exception\InvalidArgumentException;

class Type extends EncodeExtends implements TypeInterface
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
            return Encode::$type($data);
        }

        return hash($type, $data);
    }
}
