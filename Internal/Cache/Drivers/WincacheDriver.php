<?php namespace ZN\Cache\Drivers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Support;
use ZN\Cache\DriverMappingAbstract;

class WincacheDriver extends DriverMappingAbstract
{
    /**
     * Magic constructor
     * 
     * @param void
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        Support::extension('wincache');
    }

    /**
     * Select key
     * 
     * @param string $key
     * @param mixed  $compressed
     * 
     * @return mixed
     */
    public function select($key, $compressed = NULL)
    {
        $data = wincache_ucache_get($key, $success);

        return $success === true ? $data : false;
    }

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
    public function insert($key, $var, $time, $compressed)
    {
        return wincache_ucache_set($key, $var, $time);
    }

    /**
     * Delete key
     * 
     * @param string $key
     * 
     * @return bool
     */
    public function delete($key)
    {
        return wincache_ucache_delete($key);
    }

    /**
     * Increment key
     * 
     * @param string $key
     * @param int    $increment = 1
     * 
     * @return int
     */
    public function increment($key, $increment)
    {
        $value = wincache_ucache_inc($key, $increment, $success);

        return $success === true ? $value : false;
    }

    /**
     * Decrement key
     * 
     * @param string $key
     * @param int    $decrement = 1
     * 
     * @return int
     */
    public function decrement($key, $decrement)
    {
        $value = wincache_ucache_dec($key, $decrement, $success);

        return $success === true ? $value : false;
    }

    /**
     * Clean all cache
     * 
     * @param void
     * 
     * @return bool
     */
    public function clean()
    {
        return wincache_ucache_clear();
    }

    /**
     * Get info
     * 
     * @param mixed $type
     * 
     * @return array
     */
    public function info($type = NULL)
    {
        return wincache_ucache_info(true);
    }

    /**
     * Get meta data
     * 
     * @param string $key
     * 
     * @return array
     */
    public function getMetaData($key)
    {
        if( $stored = wincache_ucache_info(false, $key) )
        {
            $age      = $stored['ucache_entries'][1]['age_seconds'];
            $ttl      = $stored['ucache_entries'][1]['ttl_seconds'];
            $hitcount = $stored['ucache_entries'][1]['hitcount'];

            return
            [
                'expire'    => $ttl - $age,
                'hitcount'  => $hitcount,
                'age'       => $age,
                'ttl'       => $ttl
            ];
        }

        return [];
    }
}
