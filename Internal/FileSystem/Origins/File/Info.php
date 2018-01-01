<?php namespace ZN\FileSystem\File;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\FileSystem\Exception\FileNotFoundException;
use ZN\FileSystem\Exception\UndefinedFunctionException;
use ZN\FileSystem\Folder;
use ZN\ErrorHandling\Errors;

class Info
{
    //--------------------------------------------------------------------------------------------------------
    // Access
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected static $access = NULL;

    //--------------------------------------------------------------------------------------------------------
    // Methods
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected static $methods =
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
        return self::_is($method, ...$parameters);
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
    protected static function _is($type, $file)
    {
        $file = self::rpath($file);

        $validType = self::$methods[$type] ?? NULL;

        if( ! function_exists($validType) || $validType === NULL )
        {
            throw new UndefinedFunctionException('Error', 'undefinedFunction', Classes::onlyName(get_called_class()).'::'.$type.'()');
        }

        if( $validType($file) )
        {
            return true;
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------
    // pathInfos()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $info = 'basename'
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------
    public static function pathInfo(String $file, String $info = 'basename') : String
    {
        $pathInfo = pathinfo($file);

        return $pathInfo[$info] ?? false;
    }

    //--------------------------------------------------------------------------------------------------------
    // Required
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return array
    //
    //--------------------------------------------------------------------------------------------------------
    public static function required() : Array
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
        self::$access['realPath']              = $realPath;
        self::$access['parentDirectoryAccess'] = $parentDirectoryAccess;

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
    public static function rpath(String $file = NULL) : String
    {
        $config = \Config::get('FileSystem', 'file', self::$access);

        self::$access = NULL;

        if( $config['parentDirectoryAccess'] === false )
        {
            $file = str_replace('../', '', $file);
        }

        if( $config['realPath'] === true )
        {
            $file = prefix(self::originpath($file), REAL_BASE_DIR);
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
    public static function exists(String $file) : Bool
    {
        $file = self::rpath($file);

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
    public static function originpath(String $string) : String
    {
        return str_replace(['/', '\\'], DS, $string);
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
    public static function relativepath(String $string) : String
    {
        return str_replace(REAL_BASE_DIR, NULL, self::originpath($string));
    }

    //--------------------------------------------------------------------------------------------------
    // Absolute Path
    //--------------------------------------------------------------------------------------------------
    //
    // @param  string $string
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------
    public static function absolutePath(String $string = NULL) : String
    {
        return str_replace([REAL_BASE_DIR, DS], [NULL, '/'], $string);
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
    public static function available(String $file) : Bool
    {
        $file = self::rpath($file);

        if( file_exists($file) )
        {
            return true;
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------------
    // Info
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public static function get(String $file) : \stdClass
    {
        $file = self::rpath($file);

        if( ! is_file($file) )
        {
            throw new FileNotFoundException($file);
        }

        return (object)
        [
            'basename'   => self::pathInfo($file, 'basename'),
            'size'       => filesize($file),
            'date'       => filemtime($file),
            'readable'   => is_readable($file),
            'writable'   => is_writable($file),
            'executable' => is_executable($file),
            'permission' => fileperms($file)
        ];
    }

    //--------------------------------------------------------------------------------------------------------
    // Size -> 5.4.8[edited]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $type
    // @param int    $decimal
    //
    //--------------------------------------------------------------------------------------------------------
    public static function size(String $file, String $type = 'b', Int $decimal = 2) : Float
    {
        $file = self::rpath($file);

        if( ! file_exists($file) )
        {
            throw new FileNotFoundException($file);
        }

        $size      = 0;
        $fileSize  = filesize($file);

        if( is_file($file) )
        {
            $size += $fileSize;
        }
        else
        {
            $folderFiles = Folder\FileList::files($file);

            if( $folderFiles )
            {
                foreach( $folderFiles as $val )
                {
                    $size += self::size($file."/".$val);
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
    public static function createDate(String $file, String $type = 'd.m.Y G:i:s') : String
    {
        $file = self::rpath($file);

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
    public static function changeDate(String $file, String $type = 'd.m.Y G:i:s') : String
    {
        $file = self::rpath($file);

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
    public static function owner(String $file)
    {
        $file = self::rpath($file);

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
    public static function group(String $file)
    {
        $file = self::rpath($file);

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
    public static function rowCount(String $file = '/', Bool $recursive = true) : Int
    {
        $file = self::rpath($file);

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
            $files = Folder\FileList::allFiles($file, $recursive);

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
