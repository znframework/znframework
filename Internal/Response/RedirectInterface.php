<?php namespace ZN\Response;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

interface RedirectInterface
{
    /**
     * Get redirect status
     * 
     * @return int
     */
    public static function status() : Int;

    /**
     * Get redirect url
     * 
     * @return string
     */
    public static function url() : String;

    /**
     * Get redirect string query
     * 
     * @return string
     */
    public static function queryString() : String;

    /**
     * Page refresh.
     * 
     * @param string $url  = NULL
     * @param int    $time = 0
     * @param array  $data = NULL
     * @param bool   $exit = false
     */
    public function refresh(String $url = NULL, Int $time = 0, Array $data = NULL, Bool $exit = false);

    /**
     * Location
     *
     * @param string $url  = NULL
     * @param int    $time = 0
     * @param array  $data = NULL
     * @param bool   $exit = true
     */
    public function location
    (
        String $url  = NULL, 
        Int    $time = 0, 
        Array  $data = NULL, 
        Bool   $exit = true, 
               $type = 'location'
    );

    /**
     * Select redirect data
     * 
     * @param string $k
     * 
     * @return false|mixed
     */
    public function selectData(String $k);

    /**
     * Redirect delete data
     * 
     * @param mixed $data
     * 
     * @return true
     */
    public function deleteData($data) : Bool;

    /**
     * Action URL
     * 
     * @param string $action = NULL
     */
    public function action(String $action = NULL);

    /**
     * Sets redirect time
     * 
     * @param int $time = 0
     * 
     * @return self
     */
    public function time(Int $time = 0);

    /**
     * Sets waiting time. same time() method
     * 
     * @param int $time = 0
     * 
     * @return self
     */
    public function wait(Int $time = 0);

    /**
     * Sets redirect data
     * 
     * @param array $data
     * 
     * @return self
     */
    public function data(Array $data);

    /**
     * Insert redirect data
     * 
     * @param array $data
     * 
     * @return self
     */
    public function insert(Array $data);

    /**
     * Select redirect data
     * 
     * @param string $key
     * 
     * @return mixed
     */
    public function select(String $key);

    /**
     * Deletes redirect data
     * 
     * @param mixed $key
     * 
     * @return true
     */
    public function delete($key) : Bool;
}
