<?php namespace ZN\DataTypes;
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

class Serial implements SerialInterface
{
    //--------------------------------------------------------------------------------------------------------
    // Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function encode($data) : String
    {
        return serialize($data);
    }

    //--------------------------------------------------------------------------------------------------------
    // Decode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    // @param bool   $array
    //
    //--------------------------------------------------------------------------------------------------------
    public function decode(String $data, Bool $array = false)
    {
        if( $array === false )
        {
            return (object) unserialize($data);
        }
        else
        {
            return (array) unserialize($data);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Decode Object
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function decodeObject(String $data) : stdClass
    {
        return $this->decode($data, false);
    }

    //--------------------------------------------------------------------------------------------------------
    // Decode Array
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function decodeArray(String $data) : Array
    {
        return $this->decode($data, true);
    }
}
