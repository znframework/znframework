<?php namespace ZN\Cache;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

interface ProcessorInterface
{
    /**
     * Refresh cache
     * 
     * @param void
     * 
     * @return Cache
     */
    public function refresh();

    /**
     * Set data
     * 
     * @param array $data = NULL
     * 
     * @return Cache
     */
    public function data(Array $data = NULL);

    /**
     * Set key
     * 
     * @param string $key = NULL
     * 
     * @return Cache
     */
    public function key(String $key = NULL) : Processor;

    /**
     * Cache code
     * 
     * @param callable $function
     * @param mixed    $time       = 60
     * @param string   $compressed = 'gz'
     * 
     * @return string
     */
    public function code(Callable $function, $time = 60, String $compress = 'gz') : String;

    /**
     * Cache view
     * 
     * @param string $file
     * @param mixed  $time     = 60
     * @param string $compress = 'gz'
     * 
     * @return string
     */
    public function view(String $file, $time = 60, String $compress = 'gz') : String;

    /**
     * Cache file
     * 
     * @param string $file
     * @param mixed  $time     = 60
     * @param string $compress = 'gz'
     * 
     * @return string
     */
    public function file(String $file, $time = 60, String $compress = 'gz', $type = 'something') : String;

    /**
     * Select key
     * 
     * @param string $key
     * @param mixed  $compressed = false
     * 
     * @return mixed
     */
    public function select(String $key, $compressed = false);

    /**
     * Insert key
     * 
     * @param string $key
     * @param mixed  $var
     * @param mixed  $time       = 60
     * @param mixed  $compressed = false
     * 
     * @return bool
     */
    public function insert(String $key, $var, $time = 60, $compressed = false) : Bool;

    /**
     * Delete key
     * 
     * @param string $key
     * 
     * @return bool
     */
    public function delete(String $key) : Bool;

    /**
     * Increment key
     * 
     * @param string $key
     * @param int    $increment = 1
     * 
     * @return int
     */
    public function increment(String $key, Int $increment = 1) : Int;

    /**
     * Decrement key
     * 
     * @param string $key
     * @param int    $decrement = 1
     * 
     * @return int
     */
    public function decrement(String $key, Int $decrement = 1) : Int;

    /**
     * Clean all cache
     * 
     * @param void
     * 
     * @return bool
     */
    public function clean() : Bool;

    /**
     * Get info
     * 
     * @param mixed $type
     * 
     * @return array
     */
    public function info($info) : Array;

    /**
     * Get meta data
     * 
     * @param string $key
     * 
     * @return array
     */
    public function getMetaData(String $key) : Array;
}
