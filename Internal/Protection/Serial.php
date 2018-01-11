<?php namespace ZN\Protection;
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

class Serial extends StoreAbstract implements StoreInterface
{
    /**
     * Encode
     * 
     * @param mixed  $data
     * 
     * @return string
     */
    public static function encode($data) : String
    {
        return serialize($data);
    }

    /**
     * Decode
     * 
     * @param string $data
     * @param bool   $array = false
     * 
     * @return object
     */
    public static function decode(String $data, Bool $array = false)
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

    /**
     * Decode
     * 
     * @param string $data
     * @param bool   $array = false
     * 
     * @return object
     */
    public static function decodeObject(String $data) : stdClass
    {
        return self::decode($data, false);
    }

    /**
     * Decode Array
     * 
     * @param string $data
     * @param bool   $array = false
     * 
     * @return array
     */
    public static function decodeArray(String $data) : Array
    {
        return self::decode($data, true);
    }
}
