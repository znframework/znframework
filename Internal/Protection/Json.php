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

use ZN\Helpers\Converter;

class Json extends StoreAbstract implements StoreInterface
{
    /**
     * Encode
     * 
     * @param mixed  $data
     * @param string $type = 'unescapedUnicode'
     * 
     * @return string
     */
    public static function encode($data, String $type = 'unescapedUnicode') : String
    {
        return json_encode($data, Converter::toConstant($type, 'JSON_'));
    }

    /**
     * Decode
     * 
     * @param string $data
     * @param bool   $array  = false
     * @param int    $length = 512
     * 
     * @return mixed
     */
    public static function decode(String $data, Bool $array = false, Int $length = 512)
    {
        $return = json_decode($data, $array, $length);

        return $return;
    }

    /**
     * Decode Object
     * 
     * @param string $data
     * @param int    $length = 512
     * 
     * @return object
     */
    public static function decodeObject(String $data, Int $length = 512)
    {
        return json_decode($data, false, $length);
    }

   /**
     * Decode Array
     * 
     * @param string $data
     * @param int    $length = 512
     * 
     * @return array
     */
    public static function decodeArray(String $data, Int $length = 512) : Array
    {
        return (array) json_decode($data, true, $length);
    }

    /**
     * Error
     * 
     * @param void
     * 
     * @return string
     */
    public static function error() : String
    {
        return json_last_error_msg();
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
        return json_last_error();
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
        return ( is_array(json_decode($data, true)) && json_last_error() === 0 );
    }
}
