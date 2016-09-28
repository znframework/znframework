<?php namespace ZN\FileSystem\File;

use Folder, Config;
use ZN\FileSystem\Exception\FileNotFoundException;

class Info implements InfoInterface
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
    // Access
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $access = NULL;

    //--------------------------------------------------------------------------------------------------------
    // Methods
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $methods =
    [
        'executable' => 'is_executable',
        'writable'   => 'is_writable',
        'writeable'  => 'is_writeable',
        'readable'   => 'is_readable',
        'uploaded'   => 'is_uploaded_file'
    ];

    //--------------------------------------------------------------------------------------------------------
    // Is Control Call
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $method
    // @param array  $parameters
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function __call($method, $parameters)
    {
        return $this->_is($method, ...$parameters);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Is
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type
    // @param string $file
    //
    // @param bool
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _is($type, $file)
    {
        $file = $this->rpath($file);

        $validType = $this->methods[$type] ?? NULL;

        if( ! function_exists($validType) || $validType === NULL )
        {
            die(getErrorMessage('Error', 'undefinedFunction', Classes::onlyName(get_called_class()).'::'.$type.'()'));
        }

        if( $validType($file) )
        {
            return true;
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------------
    // Required
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return array
    //
    //--------------------------------------------------------------------------------------------------------
    public function required() : Array
    {
        return get_required_files();
    }

    //--------------------------------------------------------------------------------------------------------
    // Access
    //--------------------------------------------------------------------------------------------------------
    //
    // @param bool $realPath = true
    // @param bool $parentDirectoryAccess = false
    //
    // @param FileSystemCommon
    //
    //--------------------------------------------------------------------------------------------------------
    public function access($realPath = true, $parentDirectoryAccess = false) : Info
    {
        $this->access['realPath']              = $realPath;
        $this->access['parentDirectoryAccess'] = $parentDirectoryAccess;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Rpath
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    // @param string
    //
    //--------------------------------------------------------------------------------------------------------
    public function rpath(String $file) : String
    {
        $config = Config::get('FileSystem', 'file', $this->access);

        $this->access = NULL;

        if( $config['parentDirectoryAccess'] === false )
        {
            $file = str_replace('../', '', $file);
        }

        if( $config['realPath'] === true )
        {
            $file = prefix($this->originpath($file), REAL_BASE_DIR);
        }

        return $file;
    }

    //--------------------------------------------------------------------------------------------------------
    // Exists
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    // @param bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function exists(String $file) : Bool
    {
        $file = $this->rpath($file);

        if( is_file($file) )
        {
            return true;
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------
    // Orgin Path
    //--------------------------------------------------------------------------------------------------
    //
    // @param  string $string
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------
    public function originpath(String $string) : String
    {
        return str_replace(['/', '\\'], DS, $string);
    }

    //--------------------------------------------------------------------------------------------------------
    // Available
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    // @param bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function available(String $file) : Bool
    {
        $file = $this->rpath($file);

        if( file_exists($file) )
        {
            return true;
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------
    // Relative Path
    //--------------------------------------------------------------------------------------------------
    //
    // @param  string $string
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------
    public function relativepath(String $string) : String
    {
        return str_replace(REAL_BASE_DIR, NULL, $this->originpath($string));
    }

    //--------------------------------------------------------------------------------------------------------
    // Info
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function get(String $file) : \stdClass
    {
        $file = $this->rpath($file);

        if( ! is_file($file) )
        {
            throw new FileNotFoundException($file);
        }

        return (object)
        [
            'basename'   => pathInfos($file, 'basename'),
            'size'       => filesize($file),
            'date'       => filemtime($file),
            'readable'   => is_readable($file),
            'writable'   => is_writable($file),
            'executable' => is_executable($file),
            'permission' => fileperms($file)
        ];
    }

    //--------------------------------------------------------------------------------------------------------
    // Size
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $type
    // @param int    $decimal
    //
    //--------------------------------------------------------------------------------------------------------
    public function size(String $file, String $type = 'b', Int $decimal = 2) : Float
    {
        $file = $this->rpath($file);

        if( ! file_exists($file) )
        {
            throw new FileNotFoundException($file);
        }

        $size      = 0;
        $extension = extension($file);
        $fileSize  = filesize($file);

        if( ! empty($extension) )
        {
            $size += $fileSize;
        }
        else
        {
            $folderFiles = Folder::files($file);

            if( $folderFiles )
            {
                foreach( $folderFiles as $val )
                {
                    $size += $this->size($file."/".$val);
                }

                $size += $fileSize;
            }
            else
            {
                $size += $fileSize;
            }
        }

        // BYTES
        if( $type === "b" )
        {
            return  $size;
        }
        // KILO BYTES
        if( $type === "kb" )
        {
            return round($size / 1024, $decimal);
        }
        // MEGA BYTES
        if( $type === "mb" )
        {
            return round($size / (1024 * 1024), $decimal);
        }
        // GIGA BYTES
        if( $type === "gb" )
        {
            return round($size / (1024 * 1024 * 1024), $decimal);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Create Date
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function createDate(String $file, String $type = 'd.m.Y G:i:s') : String
    {
        $file = $this->rpath($file);

        if( ! file_exists($file) )
        {
            throw new FileNotFoundException($file);
        }

        $date = filectime($file);

        return date($type, $date);
    }

    //--------------------------------------------------------------------------------------------------------
    // Change Date
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function changeDate(String $file, String $type = 'd.m.Y G:i:s') : String
    {
        $file = $this->rpath($file);

        if( ! file_exists($file) )
        {
            throw new FileNotFoundException($file);
        }

        $date = filemtime($file);

        return date($type, $date);
    }

    //--------------------------------------------------------------------------------------------------------
    // Owner
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function owner(String $file)
    {
        $file = $this->rpath($file);

        if( ! file_exists($file) )
        {
            throw new FileNotFoundException($file);
        }

        $owner = fileowner($file);

        if( function_exists('posix_getpwuid') )
        {
            return posix_getpwuid($owner);
        }
        else
        {
            return $owner;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Group
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function group(String $file)
    {
        $file = $this->rpath($file);

        if( ! file_exists($file) )
        {
            throw new FileNotFoundException($file);
        }

        $group = filegroup($file);

        if( function_exists('posix_getgrgid') )
        {
            return posix_getgrgid($group);
        }
        else
        {
            return $group;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // rowCount()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $file
    // @param  bool   $recursive
    //
    //--------------------------------------------------------------------------------------------------------
    public function rowCount(String $file = '/', Bool $recursive = true) : Int
    {
        $file = $this->rpath($file);

        if( ! file_exists($file) )
        {
            throw new FileNotFoundException($file);
        }

        if( is_file($file) )
        {
            return count( file($file) );
        }
        elseif( is_dir($file) )
        {
            $files = Folder::allFiles($file, $recursive);

            $rowCount = 0;

            foreach( $files as $f )
            {
                if( is_file($f) )
                {
                    $rowCount += count( file($f) );
                }
            }

            return $rowCount;
        }
        else
        {
            return false;
        }
    }
}
