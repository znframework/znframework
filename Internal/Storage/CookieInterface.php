<?php namespace ZN\Storage;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

interface CookieInterface
{
    /**
     * Sets cookie time
     * 
     * @param int $time
     * 
     * @return Cookie
     */
    public function time(Int $time) : Cookie;

    /**
     * Sets cookie path
     * 
     * @param string $path
     * 
     * @return Cookie
     */
    public function path(String $path) : Cookie;

    /**
     * Sets cookie domain
     * 
     * @param string @domain
     * 
     * @return Cookie
     */
    public function domain(String $domain) : Cookie;

    /**
     * Sets secure status
     * 
     * @param bool $secure = false
     * 
     * @return Cookie
     */
    public function secure(Bool $secure) : Cookie;

    /**
     * Sets only http status
     * 
     * @param bool $httpOnly = true
     * 
     * @return Cookie
     */
    public function httpOnly(Bool $httpOnly) : Cookie;

    /**
     * Insert cookie
     * 
     * @param string $name
     * @param mixed  $value
     * @param int    $time = NULL
     * 
     * @return bool
     */
    public function insert(String $name, $value, Int $time) : Bool;

    /**
     * Select cookie
     * 
     * @param string $name
     * 
     * @return mixed
     */
    public function select(String $name);

    /**
     * Select all cookie
     * 
     * @param void
     * 
     * @return array
     */
    public function selectAll() : Array;

    /**
     * Delete cookie
     * 
     * @param string $name
     * @param string $path = NULL
     * 
     * @param bool
     */
    public function delete(String $name, String $path = NULL) : Bool;

    /**
     * Delete all cookies
     * 
     * @param void
     * 
     * @return bool
     */
    public function deleteAll() : Bool;
}
