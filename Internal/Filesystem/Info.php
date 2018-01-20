<?php namespace ZN\Filesystem;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use stdClass;
use ZN\Base;
use ZN\Config;
use ZN\Filesystem\Exception\FileNotFoundException;
use ZN\Filesystem\Exception\UndefinedFunctionException;
use ZN\Filesystem\Exception\FolderNotFoundException;

class Info
{
    /**
     * Access Status
     * 
     * @var bool
     */
    protected static $access = NULL;

    /**
     * Keeps is methods
     * 
     * @var array
     */
    protected static $methods =
    [
        'executable' => 'is_executable',
        'writable'   => 'is_writable',
        'writeable'  => 'is_writeable',
        'readable'   => 'is_readable',
        'uploaded'   => 'is_uploaded_file'
    ];

    /**
     * Magic Call
     * 
     * @param string $method
     * @param array  $parameters
     * 
     * @return bool
     */
    public function __call($method, $parameters)
    {
        return self::_is($method, ...$parameters);
    }

    /**
     * Path Info
     * 
     * @param string $file
     * @param string $info = 'basename'
     * 
     * @return string
     */
    public static function pathInfo(String $file, String $info = 'basename') : String
    {
        $pathInfo = pathinfo($file);

        return $pathInfo[$info] ?? false;
    }

    /**
     * Get required files
     * 
     * @return array
     */
    public static function required() : Array
    {
        return get_required_files();
    }

    /**
     * Sets access status
     * 
     * @param bool $realPath              = true
     * @param bool $parentDirectoryAccess = false
     * 
     * @return Info
     */
    public function access($realPath = true, $parentDirectoryAccess = false) : Info
    {
        self::$access['realPath']              = $realPath;
        self::$access['parentDirectoryAccess'] = $parentDirectoryAccess;

        return $this;
    }

    /**
     * Real Path
     * 
     * @param string $file = NULL
     * 
     * @return string
     */
    public static function rpath(String $file = NULL) : String
    {
        $config = Config::get('Filesystem', 'file', self::$access);

        self::$access = NULL;

        if( $config['parentDirectoryAccess'] === false )
        {
            $file = str_replace('../', '', $file);
        }

        if( $config['realPath'] === true )
        {
            $file = Base::prefix(self::originpath($file), REAL_BASE_DIR);
        }

        return $file;
    }

    /**
     * File Exists
     * 
     * @param string $file
     * 
     * @return bool
     */
    public static function exists(String $file) : Bool
    {
        $file = self::rpath($file);

        if( is_file($file) )
        {
            return true;
        }

        return false;
    }

    /**
     * Original Path
     * 
     * @param string $string
     * 
     * @return string
     */
    public static function originpath(String $string) : String
    {
        return str_replace(['/', '\\'], DS, $string);
    }

    /**
     * Realtive Path
     * 
     * @param string $string 
     * 
     * @return string
     */
    public static function relativepath(String $string) : String
    {
        return str_replace(REAL_BASE_DIR, NULL, self::originpath($string));
    }

    /**
     * Available
     * 
     * @param string $file
     * 
     * @return bool
     */
    public static function available(String $file) : Bool
    {
        $file = self::rpath($file);

        if( file_exists($file) )
        {
            return true;
        }

        return false;
    }

    /**
     * Get file info
     * 
     * @param string $file
     * 
     * @return object
     */
    public static function get(String $file) : stdClass
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

    /**
     * Get file size
     * 
     * @param string $file
     * @param string $type    = 'b'
     * @param int    $decimal = 2
     * 
     * @return float
     */
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
            $folderFiles = FileList::files($file);

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

    /**
     * Get create date
     * 
     * @param string $file
     * @param string $type = 'd.m.Y G:i:s'
     * 
     * @return string
     */
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

    /**
     * Get change date
     * 
     * @param string $file
     * @param string $type = 'd.m.Y G:i:s'
     * 
     * @return string
     */
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

    /**
     * Get file owner
     * 
     * @param string $file
     * 
     * @return array|int
     */
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

    /**
     * Get file group
     * 
     * @param string $file
     * 
     * @return array|int
     */
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

    /**
     * Gets number of file row
     * 
     * @return string $file      = '/'
     * @param bool    $recursive = true
     * 
     * @return int
     */
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
            $files = FileList::allFiles($file, $recursive);

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

    /**
     * Get base path
     * 
     * @return string
     */
    public static function basePath() : String
    {
        return getcwd();
    }

    /**
     * Exists Folder
     * 
     * @param string $file
     * 
     * @return bool
     */
    public static function existsFolder(String $file) : Bool
    {
        $file = self::rpath($file);

        if( is_dir($file) )
        {
            return true;
        }

        return false;
    }

    /**
     * Used to get various information about a file or directory.
     * 
     * @param string $dir
     * @param string $extension = NULL
     * 
     * @return array
     */
    public static function fileInfo(String $dir, String $extension = NULL) : Array
    {
        $dir = self::rpath($dir);

        if( is_dir($dir) )
        {
            $files = FileList::files($dir, $extension);

            $dir = Base::suffix($dir);

            $filesInfo = [];

            foreach( $files as $file )
            {
                $filesInfo[$file]['basename']   = self::pathInfo($dir.$file, 'basename');
                $filesInfo[$file]['size']       = filesize($dir.$file);
                $filesInfo[$file]['date']       = filemtime($dir.$file);
                $filesInfo[$file]['readable']   = is_readable($dir.$file);
                $filesInfo[$file]['writable']   = is_writable($dir.$file);
                $filesInfo[$file]['executable'] = is_executable($dir.$file);
                $filesInfo[$file]['permission'] = fileperms($dir.$file);
            }

            return $filesInfo;
        }
        elseif( is_file($dir) )
        {
            return (array) self::get($dir);
        }
        else
        {
            throw new FolderNotFoundException($dir);
        }
    }

    /**
     * Get free disk space
     * 
     * @param string $dir 
     * @param string $type = 'free'
     * 
     * @return float
     */
    public static function disk(String $dir, String $type = 'free') : Float
    {
        $dir = self::rpath($dir);

        if( ! is_dir($dir) )
        {
            throw new FolderNotFoundException($dir);
        }

        if( $type === 'free' )
        {
            return disk_free_space($dir);
        }
        else
        {
            return disk_total_space($dir);
        }
    }

    /**
     * Get total disk space
     * 
     * @param string $dir 
     * 
     * @return float
     */
    public static function totalSpace(String $dir) : Float
    {
        return self::disk($dir, 'total');
    }

    /**
     * Get free disk space
     * 
     * @param string $dir 
     * 
     * @return float
     */
    public static function freeSpace(String $dir) : Float
    {
        return self::disk($dir, 'free');
    }

    /**
     * Protected IS
     */
    protected static function _is($type, $file)
    {
        $file = self::rpath($file);

        $validType = self::$methods[$type] ?? NULL;

        if( ! function_exists($validType) || $validType === NULL )
        {
            throw new UndefinedFunctionException('Error', 'undefinedFunction', get_called_class().'::'.$type.'()');
        }

        if( $validType($file) )
        {
            return true;
        }

        return false;
    }
}
