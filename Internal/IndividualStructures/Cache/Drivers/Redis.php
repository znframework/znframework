<?php namespace ZN\IndividualStructures\Cache\Drivers;

use ZN\IndividualStructures\Abstracts\CacheDriverMappingAbstract;

class RedisDriver extends CacheDriverMappingAbstract
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Redis
    //--------------------------------------------------------------------------------------------------------
    //
    // @var object
    //
    //--------------------------------------------------------------------------------------------------------
    protected $redis;

    //--------------------------------------------------------------------------------------------------------
    // Serialized
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $serialized = [];

    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        \Support::extension('redis');
    }

    //--------------------------------------------------------------------------------------------------------
    // Connect
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  array $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function connect(Array $settings = NULL)
    {
        $config =  \Config::get('IndividualStructures', 'cache')['driverSettings'];

        $config = ! empty($settings)
                  ? $settings
                  : $config['redis'];

        $this->redis = new \Redis();

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
                die(\Errors::message('IndividualStructures', 'cache:connectionRefused', 'Connection'));
            }
        }
        catch( RedisException $e )
        {
            die(\Errors::message('IndividualStructures', 'cache:connectionRefused', $e->getMessage()));
        }

        if( isset($config['password']) )
        {
            if ( ! $this->redis->auth($config['password']))
            {
                die(\Errors::message('IndividualStructures', 'cache:authenticationFailed'));
            }
        }

        $serialized = $this->redis->sMembers('ZNRedisSerialized');

        if ( ! empty($serialized) )
        {
            $this->serialized = array_flip($serialized);
        }

        return true;
    }

    //--------------------------------------------------------------------------------------------------------
    // Select
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $key
    // @param  mixed  $compressed
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public function select($key, $compressed = NULL)
    {
        $value = $this->redis->get($key);

        if( $value !== false && isset($this->serialized[$key]) )
        {
            return unserialize($value);
        }

        return $value;
    }

    //--------------------------------------------------------------------------------------------------------
    // Insert
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string   $key
    // @param  variable $var
    // @param  numeric  $time
    // @param  mixed    $compressed
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Delete
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $key
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Increment
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $key
    // @param  numeric $increment
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    public function increment($key, $increment)
    {
        return $this->redis->incr($key, $increment);
    }

    //--------------------------------------------------------------------------------------------------------
    // Decrement
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $key
    // @param  numeric $decrement
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    public function decrement($key, $decrement)
    {
        return $this->redis->decr($key, $decrement);
    }

    //--------------------------------------------------------------------------------------------------------
    // Clean
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    public function clean()
    {
        return $this->redis->flushDB();
    }

    //--------------------------------------------------------------------------------------------------------
    // Info
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  mixed  $info
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public function info($type = NULL)
    {
        return $this->redis->info();
    }

    //--------------------------------------------------------------------------------------------------------
    // Get Meta Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $key
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Destruct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function __destruct()
    {
        if( ! empty($this->redis) )
        {
            $this->redis->close();
        }
    }
}
