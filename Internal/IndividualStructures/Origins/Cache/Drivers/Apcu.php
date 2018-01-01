<?php namespace ZN\IndividualStructures\Cache\Drivers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\IndividualStructures\Support;
use ZN\IndividualStructures\Abstracts\CacheDriverMappingAbstract;

class ApcuDriver extends CacheDriverMappingAbstract
{
    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $driver
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        Support::func('apcu_fetch', 'Apcu');
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
        $success = false;

        $data = apcu_fetch($key, $success);

        if( $success === true )
        {
            return ( is_array($data) )
                   ? unserialize($data[0])
                   : $data;
        }

        return false;
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
    public function insert($key, $var, $time, $compressed)
    {
        $time = (int) $time;

        return apcu_store
        (
            $key,
            $compressed === true ? $var : [serialize($var), time(), $time],
            $time
        );
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
        return apcu_delete($key);
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
        return apcu_inc($key, $increment);
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
        return apcu_dec($key, $decrement);
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
        return apcu_clear_cache('user');
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
        return apcu_cache_info($type);
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
        $success = false;
        $stored  = apcu_fetch($key, $success);

        if( $success === false || count($stored) !== 3 )
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
}
