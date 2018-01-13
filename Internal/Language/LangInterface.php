<?php namespace ZN\Language;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

interface LangInterface
{
    /**
     * Get short codes
     * 
     * @param string $code = NULL
     * 
     * @return mixed
     */
    public static function shortCodes(String $code = NULL);

    /**
     * Get current lang code
     * 
     * @param void
     * 
     * @return mixed
     */
    public static function current();

    /**
     * Get language content
     * 
     * @param string $file    = NULL
     * @param string $str     = NULL
     * @param mixed  $changed = NULL
     * 
     * @return mixed
     */
    public static function select(String $file = NULL, String $str = NULL, $changed = NULL);

    /**
     * Sets language
     * 
     * @param string $l = NULL
     * 
     * @return bool
     */
    public static function set(String $l = NULL) : Bool;

    /**
     * Get language short code
     * 
     * @return string
     */
    public static function get() : String;
}
