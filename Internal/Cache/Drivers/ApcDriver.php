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

class ApcDriver extends DriverMappingAbstract
{
    /**
     * Keeps apc type
     * 
     * @var string
     */
    protected $apc = 'apc';

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
        
        Support::extension($this->apc);
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
        $data = $this->apc('fetch', $key);

        return ( is_array($data) ) ? unserialize($data[0]) : $data;
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
        $time = (int)$time;

        return $this->apc
        (
            'store', 
            $key,
            $compressed === true ? $var : [serialize($var), time(), $time],
            $time
        );
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
        return $this->apc('delete', $key);
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
        return $this->apc('inc', $key, $increment);
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
        return $this->apc('dec', $key, $decrement);
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
        return$this->apc('clear_cache', 'user');
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
        return $this->apc('cache_info', $type);
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
        $stored  = $this->apc('fetch', $key);

        if( count($stored) !== 3 )
        {
            return [];
        }

        list($data, $time, $expire) = $stored;

        return
        [
            'expire' => $time + $expire,
            'mtime'  => $time,
            'data'   => unserialize($data)
        ];
    }

    /**
     * Apc type
     * 
     * @param string $type
     * @param mixed  ...$args
     */
    protected function apc(String $type, ...$args)
    {
        $method = $this->apc . '_' . $type;

        return $method(...$args);
    }
}
