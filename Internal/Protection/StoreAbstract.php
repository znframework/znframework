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
    public function encode(...$data) : String {}

    /**
     * Decode
     * 
     * @param string $data
     * @param bool   $array  = false
     * @param int    $length = 512
     * 
     * @return mixed
     */
    public function decode(...$data) {}

    /**
     * Decode Object
     * 
     * @param string $data
     * @param int    $length = 512
     * 
     * @return object
     */
    public function decodeObject(...$data) {}

   /**
     * Decode Array
     * 
     * @param string $data
     * @param int    $length = 512
     * 
     * @return array
     */
    public function decodeArray(...$data) : Array {}

    /**
     * Error
     * 
     * @param void
     * 
     * @return string
     */
    public function error() : String {}
    
    /** 
     * Error No
     * 
     * @param void
     * 
     * @return int
     */
    public function errno() : Int {}
    
    /** 
     * Check
     * 
     * @param string $data
     * 
     * @return bool
     */
    public function check(...$data) : Bool {}
}
