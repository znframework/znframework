<?php namespace ZN\DataTypes\Json;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Decode
{
    //--------------------------------------------------------------------------------------------------------
    // Do
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    // @param bool   $array
    // @param int    $length
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do(String $data, Bool $array = false, Int $length = 512)
    {
        $return = json_decode($data, $array, $length);

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
    public static function object(String $data, Int $length = 512)
    {
        return json_decode($data, false, $length);
    }

    //--------------------------------------------------------------------------------------------------------
    // Decode Array
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    // @param int    $length
    //
    //--------------------------------------------------------------------------------------------------------
    public static function array(String $data, Int $length = 512) : Array
    {
        return (array) json_decode($data, true, $length);
    }
}
