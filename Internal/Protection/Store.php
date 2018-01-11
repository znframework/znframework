<?php namespace ZN\Protection;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Singleton;

class Store
{
    protected static $drivers = ['json', 'separator', 'serial'];
    /**
     * Store Class
     * 
     * @var StoreInterface
     */
    protected $store;

    /**
     * Magic Constructor
     * 
     * @param StoreInterface $store
     */
    public function __construct(StoreInterface $store = NULL)
    {
        $this->store = $store;
    }

    /**
     * Get driver
     * 
     * @param string $class
     * 
     * @return ZN\Singleton
     */
    public static function driver(String $class)
    {
        if( ! in_array($class, self::$drivers) )
        {
            throw new UnsupportedDriverException(NULL, $driver);
        }

        $class = 'ZN\Protection\\' . ucfirst($class);

        return Singleton::class($class);
    }

    /**
     * Encode
     * 
     * @param mixed  $data
     * @param string $type = 'unescapedUnicode'
     * 
     * @return string
     */
    public function encode(...$data) : String 
    {
        return $this->store->encode(...$data);
    }

    /**
     * Decode
     * 
     * @param string $data
     * @param bool   $array  = false
     * @param int    $length = 512
     * 
     * @return mixed
     */
    public function decode(...$data) 
    {
        return $this->store->decode(...$data);
    }

    /**
     * Decode Object
     * 
     * @param string $data
     * @param int    $length = 512
     * 
     * @return object
     */
    public function decodeObject(...$data) 
    {
        return $this->store->decodeObject(...$data);
    }

    /**
     * Decode Array
     * 
     * @param string $data
     * @param int    $length = 512
     * 
     * @return array
     */
    public function decodeArray(...$data) : Array 
    {
        return $this->store->decodeArray(...$data);
    }

    /**
     * Error
     * 
     * @param void
     * 
     * @return string
     */
    public function error() : String 
    {
        return $this->store->error();
    }
    
    /** 
     * Error No
     * 
     * @param void
     * 
     * @return int
     */
    public function errno() : Int 
    {
        return $this->store->errno();
    }
    
    /** 
     * Check
     * 
     * @param string $data
     * 
     * @return bool
     */
    public function check(...$data) : Bool 
    {
        return $this->store->check(...$data);
    }
}
