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

/**
 * Default Cookie Configuration
 * 
 * Enabled when the configuration file can not be accessed.
 */
class CacheDefaultConfiguration
{
    /*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    |
    | Includes configurations for the Cache library.
    |
    | drivers       : apc, memcache, wincache, file, redis
    | driverSettings: Configurations by driver
    |
    */

    public $driver         = 'file';
    public $driverSettings =
    [
        'memcache' =>
        [
            'host'   => '127.0.0.1',
            'port'   => '11211',
            'weight' => '1',
        ],
        'redis' =>
        [
            'password'   => NULL,
            'socketType' => 'tcp',
            'host'       => '127.0.0.1',
            'port'       => 6379,
            'timeout'    => 0
        ]
    ];
}
