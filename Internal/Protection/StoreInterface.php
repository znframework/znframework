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

interface StoreInterface
{
    /**
     * Encode
     * 
     * @param mixed  $data
     * @param string $type = 'unescapedUnicode'
     * 
     * @return string
     */
    public static function encode($data) : String;

    /**
     * Decode
     * 
     * @param string $data
     * @param bool   $array  = false
     * @param int    $length = 512
     * 
     * @return mixed
     */
    public static function decode(String $data);

    /**
     * Decode Object
     * 
     * @param string $data
     * 
     * @return object
     */
    public static function decodeObject(String $data);

   /**
     * Decode Array
     * 
     * @param string $data
     * 
     * @return array
     */
    public static function decodeArray(String $data) : Array;

    /**
     * Error
     * 
     * @param void
     * 
     * @return string
     */
    public static function error() : String;
    
    /** 
     * Error No
     * 
     * @param void
     * 
     * @return int
     */
    public static function errno() : Int;
    
    /** 
     * Check
     * 
     * @param string $data
     * 
     * @return bool
     */
    public static function check(String $data) : Bool;
}
