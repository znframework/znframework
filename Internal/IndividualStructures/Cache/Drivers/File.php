<?php namespace ZN\IndividualStructures\Cache\Drivers;

use ZN\IndividualStructures\Abstracts\CacheDriverMappingAbstract;
use File, Folder, Support, Compress;

class FileDriver extends CacheDriverMappingAbstract
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
    // Path
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $path;

    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        $this->path = STORAGE_DIR.'Cache/';

        if( ! is_dir($this->path) )
        {
            Folder::create($this->path, 0755);
        }

        Support::writable($this->path);
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
    public function select($key, $compressed)
    {
        $data = $this->_select($key);

        if( ! empty($data['data']) )
        {
            if( $compressed !== false )
            {
                $data['data'] = Compress::driver($compressed)->undo($data['data']);
            }

            return $data['data'];
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
        if( $compressed !== false )
        {
            $var = Compress::driver($compressed)->do($var);
        }

        $datas =
        [
            'time'  => time(),
            'ttl'   => $time,
            'data'  => $var
        ];

        if( File::write($this->path.$key, serialize($datas)) )
        {
            File::permission($this->path.$key, 0640);

            return true;
        }

        return false;
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
        return File::delete($this->path.$key);
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
        return Folder::delete($this->path);
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
        $info = Folder::fileInfo($this->path);

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
        if( ! file_exists($this->path.$key) )
        {
            return [];
        }

        $data = unserialize(File::read($this->path.$key));

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

    //--------------------------------------------------------------------------------------------------------
    // Protected Select
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $key
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _select($key)
    {
        if( ! File::available($this->path.$key) )
        {
            return false;
        }

        $data = unserialize(File::read($this->path.$key));

        if( $data['ttl'] > 0 && time() > $data['time'] + $data['ttl'] )
        {
            File::delete($this->path.$key);

            return false;
        }

        return $data;
    }
}
