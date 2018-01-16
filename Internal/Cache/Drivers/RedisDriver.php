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

use Redis;
use RedisException;
use ZN\Support;
use ZN\ErrorHandling\Errors;
use ZN\Cache\Exception\ConnectionRefusedException;
use ZN\Cache\Exception\AuthenticationFailedException;
use ZN\Cache\DriverMappingAbstract;

class RedisDriver extends DriverMappingAbstract
{
    /**
     * Keeps redis class
     * 
     * @var Redis
     */
    protected $redis;

    /**
     * Serialized data
     * 
     * @var array
     */
    protected $serialized = [];

    /**
     * Magic constructor
     * 
     * @param array $settings = NULL
     * 
     * @return void
     */
    public function __construct(Array $settings = NULL)
    {
        parent::__construct();
        
        Support::extension('redis');

        $config =  $this->config['driverSettings'];

        $config = ! empty($settings)
                  ? $settings
                  : $config['redis'];

        $this->redis = new Redis();

        try
        {
            if( $config['socketType'] === 'unix' )
            {
                $success = $this->redis->connect($config['socket']);
            }
            else
            {
                $success = $this->redis->connect($config['host'], $config['port'], $config['timeout']);
            }

            if ( empty($success) )
            {
                throw new ConnectionRefusedException(NULL, 'Connection');
            }
        }
        catch( RedisException $e )
        {
            throw new ConnectionRefusedException(NULL, $e->getMessage());
        }

        if( isset($config['password']) )
        {
            if ( ! $this->redis->auth($config['password']))
            {
                throw new AuthenticationFailedException;
            }
        }

        $serialized = $this->redis->sMembers('ZNRedisSerialized');

        if ( ! empty($serialized) )
        {
            $this->serialized = array_flip($serialized);
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
        $value = $this->redis->get($key);

        if( $value !== false && isset($this->serialized[$key]) )
        {
            return unserialize($value);
        }

        return $value;
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
    public function insert($key, $data, $time, $compressed)
    {
        if( is_array($data) OR is_object($data) )
        {
            if( ! $this->redis->sIsMember('ZNRedisSerialized', $key) && ! $this->redis->sAdd('ZNRedisSerialized', $key) )
            {
                return false;
            }

            if( ! isset($this->serialized[$key]) )
            {
                $this->serialized[$key] = true;
            }

            $data = serialize($data);
        }
        elseif( isset($this->serialized[$key]) )
        {
            $this->serialized[$key] = NULL;

            $this->redis->sRemove('ZNRedisSerialized', $key);
        }

        return $this->redis->set($key, $data, $time);
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
        if( $this->redis->delete($key) !== 1 )
        {
            return false;
        }

        if( isset($this->serialized[$key]) )
        {
            $this->serialized[$key] = NULL;

            $this->redis->sRemove('ZNRedisSerialized', $key);
        }

        return true;
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
        return $this->redis->incr($key, $increment);
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
        return $this->redis->decr($key, $decrement);
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
        return $this->redis->flushDB();
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
        return $this->redis->info();
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
        $data = $this->select($key);

        if( $data !== false )
        {
            return
            [
                'expire' => time() + $this->redis->ttl($key),
                'data'   => $data
            ];
        }

        return [];
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
        if( ! empty($this->redis) )
        {
            $this->redis->close();
        }
    }
}
