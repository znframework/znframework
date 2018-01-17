<?php namespace ZN\Request;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

interface URLInterface
{
    /**
     * Get base name
     * 
     * @param string $uri = NULL
     * 
     * @return string
     */
    public static function base(String $uri = NULL) : String;

    /**
     * Get site URL
     * 
     * @param string $uri = NULL
     * 
     * @return string
     */
    public static function site(String $uri = NULL) : String;

    /**
     * Get site URLs
     * 
     * @param string $uri = NULL
     * 
     * @return string
     */
    public static function sites(String $uri = NULL) : String;

    /**
     * Get current URL
     * 
     * @param string $uri = NULL
     * 
     * @return string
     */
    public static function current(String $fix = NULL) : String;

    /**
     * Get prev URL
     * 
     * @return string
     */
    public static function prev() : String;

    /**
     * Build Query
     * 
     * @param mixed $data
     * @param string $numericPrefix = NULL
     * @param string $separator     = NULL
     * @param int    $enctype       = PHP_QUERY_RFC1738
     * 
     * @return mixed
     */
    public static function buildQuery($data, String $numericPrefix = NULL, String $separator = NULL, Int $enctype = PHP_QUERY_RFC1738) : String;

    /**
     * Parse URL
     * 
     * @param string $url
     * @param mixed  $component = 1
     * 
     * @return mixed
     */
    public static function parse(String $url, $component = 1);
}
