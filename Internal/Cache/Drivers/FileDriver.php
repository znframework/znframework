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
use ZN\Singleton;
use ZN\Filesystem;
use ZN\Cache\DriverMappingAbstract;

class FileDriver extends DriverMappingAbstract
{
    /**
     * Keeps path
     * 
     * @var string
     */
    protected $path = STORAGE_DIR . 'Cache/';

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
        
        if( ! is_dir($this->path) )
        {
            mkdir($this->path, 0755);
        }

        Support::writable($this->path);

        $this->compress = Singleton::class('ZN\Compression\Force');
    }

    /**
     * Select key
     * 
     * @param string $key
     * @param mixed  $compressed
     * 
     * @return mixed
     */
    public function select($key, $compressed)
    {
        $data = $this->_select($key);

        if( ! empty($data['data']) )
        {
            if( $compressed !== false )
            {
                $data['data'] = $this->compress->driver($compressed)->undo($data['data']);
            }

            return $data['data'];
        }

        return false;
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
        if( $compressed !== false )
        {
            $var = $this->compress->driver($compressed)->do($var);
        }

        $datas =
        [
            'time'  => time(),
            'ttl'   => $time,
            'data'  => $var
        ];

        if( file_put_contents($this->path.$key, serialize($datas)) )
        {
            chmod($this->path.$key, 0640);

            return true;
        }

        return false;
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
        return unlink($this->path . $key);
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
        $data = $this->_select($key);

        if( $data === false )
        {
            $data = ['data' => 0, 'ttl' => 60];
        }
        elseif( ! is_numeric($data['data']) )
        {
            return false;
        }

        $newValue = $data['data'] + $increment;

        return ( $this->insert($key, $newValue, $data['ttl']) )
               ? $newValue
               : false;
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
        $data = $this->_select($key);

        if( $data === false )
        {
            $data = ['data' => 0, 'ttl' => 60];
        }
        elseif( ! is_numeric($data['data']) )
        {
            return false;
        }

        $newValue = $data['data'] - $decrement;

        return $this->insert($key, $newValue, $data['ttl'])
               ? $newValue
               : false;
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
        return Filesystem\Forge::deleteFolder($this->path);
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
        $info = Filesystem\Info::fileInfo($this->path);

        if( $type === NULL )
        {
            return $info;
        }
        elseif( ! empty($info[$type]) )
        {
            return $info[$type];
        }

        return [];
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
        if( ! file_exists($this->path.$key) )
        {
            return [];
        }

        $data = unserialize(file_get_contents($this->path.$key));

        if( is_array($data) )
        {
            $mtime = filemtime($this->path.$key);

            if( ! isset($data['ttl']) )
            {
                return false;
            }

            return
            [
                'expire' => $mtime + $data['ttl'],
                'mtime'  => $mtime
            ];
        }

        return [];
    }

    /**
     * protected select key
     * 
     * @param string $key
     * 
     * @return mixed
     */
    protected function _select($key)
    {
        if( ! file_exists($this->path.$key) )
        {
            return false;
        }

        $data = unserialize(file_get_contents($this->path.$key));

        if( $data['ttl'] > 0 && time() > $data['time'] + $data['ttl'] )
        {
            unlink($this->path.$key);

            return false;
        }

        return $data;
    }
}
