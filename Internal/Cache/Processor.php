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

use ZN\Buffering;
use ZN\Inclusion;
use ZN\Ability\Driver;
use ZN\Helpers\Converter;

class Processor implements ProcessorInterface
{
    use Driver;

    /**
     * Driver settings
     * 
     * @param array  options
     * @param string namespace
     */
    const driver =
    [
        'options'   => ['file', 'apc', 'apcu', 'memcache', 'redis', 'wincache'],
        'namespace' => 'ZN\Cache\Drivers',
        'config'    => 'Storage:cache',
        'default'   => 'ZN\Cache\CacheDefaultConfiguration'
    ];
    
    protected $codeCount = 0;
    protected $refresh   = false;
    protected $key       = NULL;

    /**
     * Refresh cache
     * 
     * @param void
     * 
     * @return Cache
     */
    public function refresh()
    {
        $this->refresh = true;

        return $this;
    }

    /**
     * Set data
     * 
     * @param array $data = NULL
     * 
     * @return Cache
     */
    public function data(Array $data = NULL)
    {
        Inclusion\Properties::data($data);

        return $this;
    }

    /**
     * Set key
     * 
     * @param string $key = NULL
     * 
     * @return Cache
     */
    public function key(String $key = NULL) : Processor
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Cache code
     * 
     * @param callable $function
     * @param mixed    $time       = 60
     * @param string   $compressed = 'gz'
     * 
     * @return string
     */
    public function code(Callable $function, $time = 60, String $compress = 'gz') : String
    {
        $this->codeCount++;

        if( $this->key === NULL )
        {
            $name = 'code-' . $this->codeCount . '-' . CURRENT_CONTROLLER . '-' . CURRENT_CFUNCTION;
        }
        else
        {
            $name = $this->key;

            $this->key = NULL;
        }

        $this->_refresh($name);

        if( ! $select = $this->select($name, $compress) )
        {
            $output = Buffering\Callback::do($function);

            $this->insert($name, $output, $time, 'gz');

            return $output;
        }
        else
        {
            return $select;
        }
    }

    /**
     * Cache view
     * 
     * @param string $file
     * @param mixed  $time     = 60
     * @param string $compress = 'gz'
     * 
     * @return string
     */
    public function view(String $file, $time = 60, String $compress = 'gz') : String
    {
        return $this->file($file, $time, $compress, 'view');
    }

    /**
     * Cache file
     * 
     * @param string $file
     * @param mixed  $time     = 60
     * @param string $compress = 'gz'
     * 
     * @return string
     */
    public function file(String $file, $time = 60, String $compress = 'gz', $type = 'something') : String
    {
        $name = Converter::slug($file);

        $this->_refresh($name);

        if( ! $select = $this->select($name, $compress) )
        {
            Inclusion\Properties::usable();

            if( $type === 'shomething' )
            {
                $output = Inclusion\Something::use($file);
            }
            else
            {
                $output = Inclusion\View::use($file);
            }

            $this->insert($name, $output, $time, 'gz');

            return $output;
        }
        else
        {
            return $select;
        }
    }

    /**
     * Select key
     * 
     * @param string $key
     * @param mixed  $compressed = false
     * 
     * @return mixed
     */
    public function select(String $key, $compressed = false)
    {
        return $this->driver->select($key, $compressed);
    }

    /**
     * Insert key
     * 
     * @param string $key
     * @param mixed  $var
     * @param mixed  $time       = 60
     * @param mixed  $compressed = false
     * 
     * @return bool
     */
    public function insert(String $key, $var, $time = 60, $compressed = false) : Bool
    {
        $timeEx = explode(' ', $time);

        $time = Converter::time($timeEx[0], $timeEx[1] ?? 'second', 'second');

        return $this->driver->insert($key, $var, $time, $compressed);
    }

    /**
     * Delete key
     * 
     * @param string $key
     * 
     * @return bool
     */
    public function delete(String $key) : Bool
    {
        return $this->driver->delete($key);
    }

    /**
     * Increment key
     * 
     * @param string $key
     * @param int    $increment = 1
     * 
     * @return int
     */
    public function increment(String $key, Int $increment = 1) : Int
    {
        return $this->driver->increment($key, $increment);
    }

    /**
     * Decrement key
     * 
     * @param string $key
     * @param int    $decrement = 1
     * 
     * @return int
     */
    public function decrement(String $key, Int $decrement = 1) : Int
    {
        return $this->driver->decrement($key, $decrement);
    }

    /**
     * Clean all cache
     * 
     * @param void
     * 
     * @return bool
     */
    public function clean() : Bool
    {
        return $this->driver->clean();
    }

    /**
     * Get info
     * 
     * @param mixed $type
     * 
     * @return array
     */
    public function info($type = NULL) : Array
    {
        return $this->driver->info($type);
    }

    /**
     * Get meta data
     * 
     * @param string $key
     * 
     * @return array
     */
    public function getMetaData(String $key) : Array
    {
        return $this->driver->getMetaData($key);
    }

    /**
     * protected refresh
     * 
     * @param string $data
     * 
     * @return void
     */
    protected function _refresh($data)
    {
        if( $this->refresh === true )
        {
            $this->delete($data);
            $this->refresh = false;
        }
    }
}
