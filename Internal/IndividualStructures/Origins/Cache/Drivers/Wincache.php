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

class WincacheDriver extends CacheDriverMappingAbstract
{
    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        Support::extension('wincache');
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

        $data = wincache_ucache_get($key, $success);

        return ( $success )
               ? $data
               : false;
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
        return wincache_ucache_set($key, $var, $time);
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
        return wincache_ucache_delete($key);
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
        $success = false;

        $value = wincache_ucache_inc($key, $increment, $success);

        return ( $success === true )
               ? $value
               : false;
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
        $success = false;
        $value   = wincache_ucache_dec($key, $decrement, $success);

        return ( $success === true )
               ? $value
               : false;
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
        return wincache_ucache_clear();
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
        return wincache_ucache_info(true);
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
