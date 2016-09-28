<?php namespace ZN\DataTypes\Json;

use Converter;
use ZN\DataTypes\Json\Exception\JsonErrorException;

class Encode implements EncodeInterface
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
    // Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed  $data
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function do($data, String $type = 'unescaped_unicode') : String
    {
        $return = json_encode($data, Converter::toConstant($type, 'JSON_'));

        if( ErrorInfo::no() )
        {
            throw new JsonErrorException('[Json::encode()] -> '.ErrorInfo::message());
        }

        return $return;
    }
}
