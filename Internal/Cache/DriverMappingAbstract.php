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

use ZN\Config;

abstract class DriverMappingAbstract
{
    /**
     * Keeps cache config
     * 
     * @var array
     */
    protected $config;

    /**
     * Magic Constructor
     */
    public function __construct()
    {
        $this->config = Config::default(new CacheDefaultConfiguration)::get('Storage', 'cache');
    }

    /**
     * Select key
     * 
     * @param string $key
     * @param mixed  $compressed
     * 
     * @return mixed
     */
    abstract public function select($key, $compressed);
    
    /**
     * Insert key
     * 
     * @param string $key
     * @param mixed  $var
     * @param int    $time
     * @param mixed  $compressed
     * 
     * @return bool
     */
    abstract public function insert($key, $var, $time, $compressed);
    
    /**
     * Delete key
     * 
     * @param string $key
     * 
     * @return bool
     */
    abstract public function delete($key);
    
    /**
     * Increment key
     * 
     * @param string $key
     * @param int    $increment = 1
     * 
     * @return int
     */
    abstract public function increment($key, $increment);
    
    /**
     * Decrement key
     * 
     * @param string $key
     * @param int    $decrement = 1
     * 
     * @return int
     */
    abstract public function decrement($key, $decrement);
    
    /**
     * Clean all cache
     * 
     * @param void
     * 
     * @return bool
     */
    abstract public function clean();   

    /**
     * Get info
     * 
     * @param mixed $type
     * 
     * @return array
     */
    abstract public function info($type);
    
    /**
     * Get meta data
     * 
     * @param string $key
     * 
     * @return array
     */
    abstract public function getMetaData($key);
}