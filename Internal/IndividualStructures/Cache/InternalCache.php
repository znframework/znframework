<?php namespace ZN\IndividualStructures;

use Support, CLController, DriverAbility, Buffer, Converter, Import;

class InternalCache extends CLController implements InternalCacheInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    use DriverAbility;

    //--------------------------------------------------------------------------------------------------------
    // Consts
    //--------------------------------------------------------------------------------------------------------
    //
    // @const string
    //
    //--------------------------------------------------------------------------------------------------------
    const config = 'IndividualStructures:cache';
    const driver =
    [
        'options'   => ['file', 'apc', 'apcu', 'memcache', 'redis', 'wincache', 'opcache'],
        'namespace' => 'ZN\IndividualStructures\Cache\Drivers'
    ];

    protected $codeCount = 0;
    protected $refresh   = false;
    protected $key       = NULL;

    //--------------------------------------------------------------------------------------------------------
    // Refresh -> 5.3.31
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function refresh()
    {
        $this->refresh = true;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Data -> 5.3.31
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  array $data = NULL
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function data(Array $data = NULL)
    {
        Import::data($data);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Name -> 5.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  array $data = NULL
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function key(String $key = NULL) : InternalCache
    {
        $this->key = $key;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Code
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  callable $function
    // @param  scalar   $time     = 60
    // @param  string   $compress = 'gz'
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
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
            $output = Buffer::callback($function);

            $this->insert($name, $output, $time, 'gz');

            return $output;
        }
        else
        {
            return $select;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // View -> 5.3.21
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $function
    // @param  scalar $time     = 60
    // @param  string $compress = 'gz'
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function view(String $file, $time = 60, String $compress = 'gz') : String
    {
        return $this->file($file, $time, $compress, 'view');
    }

    //--------------------------------------------------------------------------------------------------------
    // File -> 5.3.21
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $function
    // @param  scalar $time     = 60
    // @param  string $compress = 'gz'
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function file(String $file, $time = 60, String $compress = 'gz', $type = 'something') : String
    {
        $name = Converter::slug($file);

        $this->_refresh($name);

        if( ! $select = $this->select($name, $compress) )
        {
            Import::usable();

            if( $type === 'shomething' )
            {
                $output = Import::something($file);
            }
            else
            {
                $output = Import::view($file);
            }

            $this->insert($name, $output, $time, 'gz');

            return $output;
        }
        else
        {
            return $select;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Select
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $key
    // @param  mixed $expressed
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public function select(String $key, $compressed = false)
    {
        return $this->driver->select($key, $compressed);
    }

    //--------------------------------------------------------------------------------------------------------
    // Insert
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $key
    // @param  variable $var
    // @param  scalar $time
    // @param  mixed $expressed
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function insert(String $key, $var, $time = 60, $compressed = false) : Bool
    {
        $timeEx = explode(' ', $time);

        $time = Converter::time($timeEx[0], $timeEx[1] ?? 'second', 'second');

        return $this->driver->insert($key, $var, $time, $compressed);
    }

    //--------------------------------------------------------------------------------------------------------
    // Delete
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $key
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public function delete(String $key) : Bool
    {
        return $this->driver->delete($key);
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
    public function increment(String $key, Int $increment = 1) : Int
    {
        return $this->driver->increment($key, $increment);
    }

    //--------------------------------------------------------------------------------------------------------
    // Deccrement
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $key
    // @param  numeric $decrement
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    public function decrement(String $key, Int $decrement = 1) : Int
    {
        return $this->driver->decrement($key, $decrement);
    }

    //--------------------------------------------------------------------------------------------------------
    // Clean
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    public function clean() : Bool
    {
        return $this->driver->clean();
    }

    //--------------------------------------------------------------------------------------------------------
    // Info
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  mixed  $info
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public function info($type = NULL) : Array
    {
        return $this->driver->info($type);
    }

    //--------------------------------------------------------------------------------------------------------
    // Get Meta Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $key
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public function getMetaData(String $key) : Array
    {
        return $this->driver->getMetaData($key);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Refresh
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $key
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _refresh($data)
    {
        if( $this->refresh === true )
        {
            $this->delete($data);
            $this->refresh = false;
        }
    }
}
