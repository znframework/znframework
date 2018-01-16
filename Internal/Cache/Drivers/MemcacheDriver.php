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

use Memcache;
use ZN\Support;
use ZN\ErrorHandling\Errors;
use ZN\Cache\DriverMappingAbstract;
use ZN\Cache\Exception\UnsupportedDriverException;

class MemcacheDriver extends DriverMappingAbstract
{
    /**
     * Magic constructor
     * 
     * @param void
     * 
     * @return void
     */
    public function __construct(Array $settings = NULL)
    {
        parent::__construct();
        
        Support::func('memcache_add_server', 'Memcache');

        $this->memcache = new Memcache;

        $config = $this->config['driverSettings'];

        $config = ! empty($settings)
                  ? $settings
                  : $config['memcache'];
        
        $connect = $this->memcache->addServer($config['host'], $config['port'], true, $config['weight']);
        
        if( empty($connect) )
        {
            throw new UnsupportedDriverException(NULL, 'Memcache');
        }

        return true;
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
        $data = $this->memcache->get($key);

        return ( is_array($data) )
               ? $data[0]
               : $data;
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
        if( $compressed !== true )
        {
            $var = [$var, time(), $time];
        }

        return $this->memcache->set($key, $var, 0, $time);
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
        return $this->memcache->delete($key);
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
        return $this->memcache->increment($key, $increment);
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
        $this->memcache->decrement($key, $decrement);
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
        return $this->memcache->flush();
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
        return $this->memcache->getStats(true);
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
        $stored = $this->memcache->get($key);

        if( count($stored) !== 3 )
        {
            return [];
        }

        list($data, $time, $expire) = $stored;

        return
        [
            'expire' => $time + $expire,
            'mtime'  => $time,
            'data'   => $data
        ];
    }

    /**
     * Magic destructor
     * 
     * @param void
     * 
     * @return void
     */
    public function __destruct()
    {
        if( ! empty($this->memcache) )
        {
            $this->memcache->close();
        }
    }
}
