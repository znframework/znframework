<?php namespace ZN\FileSystem\File;

use Folder;
use ZN\FileSystem\Exception\FileNotFoundException;
use ZN\FileSystem\FileSystemCommon;

class FileInfo extends FileSystemCommon
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

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

    //--------------------------------------------------------------------------------------------------------
    // Info
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function info(String $file) : \stdClass
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
