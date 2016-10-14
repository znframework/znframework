<?php namespace ZN\DataTypes\Json;

use ZN\DataTypes\Json\Exception\JsonErrorException;

class Decode implements DecodeInterface
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
    // @param string $data
    // @param bool   $array
    // @param int    $length
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(String $data, Bool $array = false, Int $length = 512)
    {
        $return = json_decode($data, $array, $length);

        if( ErrorInfo::no() )
        {
            try
            {
                throw new JsonErrorException('[Json::decode()] -> '.ErrorInfo::message());
            }
            catch( JsonErrorException $e )
            {
                $e->continue();
            }
        }

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Decode Object
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    // @param int    $length
    //
    //--------------------------------------------------------------------------------------------------------
    public function object(String $data, Int $length = 512)
    {
        return $this->do($data, false, $length);
    }

    //--------------------------------------------------------------------------------------------------------
    // Decode Array
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    // @param int    $length
    //
    //--------------------------------------------------------------------------------------------------------
    public function array(String $data, Int $length = 512) : Array
    {
        return $this->do($data, true, $length);
    }
}
