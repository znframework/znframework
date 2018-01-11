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

abstract class StoreAbstract
{
    /**
     * Encode
     * 
     * @param mixed  $data
     * @param string $type = 'unescapedUnicode'
     * 
     * @return string
     */
    abstract public static function encode($data) : String;

    /**
     * Decode
     * 
     * @param string $data
     * @param bool   $array  = false
     * @param int    $length = 512
     * 
     * @return mixed
     */
    abstract public static function decode(String $data);

    /**
     * Decode Object
     * 
     * @param string $data
     * @param int    $length = 512
     * 
     * @return object
     */
    abstract public static function decodeObject(String $data);

   /**
     * Decode Array
     * 
     * @param string $data
     * @param int    $length = 512
     * 
     * @return array
     */
    abstract public static function decodeArray(String $data) : Array;

    /**
     * Error
     * 
     * @param void
     * 
     * @return string
     */
    public static function error() : String
    {
        return false;
    }
    
    /** 
     * Error No
     * 
     * @param void
     * 
     * @return int
     */
    public static function errno() : Int
    {
        return 0;
    }
    
    /** 
     * Check
     * 
     * @param string $data
     * 
     * @return bool
     */
    public static function check(String $data) : Bool
    {
        return true;
    }
}
