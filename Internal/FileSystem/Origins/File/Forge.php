<?php namespace ZN\FileSystem\File;

use ZN\FileSystem\Exception\FileNotFoundException;
use ZN\FileSystem\Generate;
use ZN\FileSystem\Folder;

class Forge
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
    // Generate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function generate() : Generate
    {
        return new Generate;
    }

    //--------------------------------------------------------------------------------------------------------
    // Create
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    //
    //--------------------------------------------------------------------------------------------------------
    public static function create(String $name) : Bool
    {
        $name = Info::rpath($name);

        if( ! is_file($name) )
        {
            return touch($name);
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------------
    // Replace
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param mixed  $data
    // @param mixed  $replace
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public static function replace(String $file, $data, $replace) : String
    {
        $file = Info::rpath($file);

        if( ! is_file($file))
        {
            return false;
        }

        $contents         = file_get_contents($file);
        $replaceContents  = str_ireplace($data, $replace, $contents);

        if( $contents !== $replaceContents )
        {
            file_put_contents($file, $replaceContents);
        }

        return $replaceContents;
    }

    //--------------------------------------------------------------------------------------------------------
    // Delete
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    //
    //--------------------------------------------------------------------------------------------------------
    public static function delete(String $name) : Bool
    {
        $name = Info::rpath($name);

        if( ! is_file($name))
        {
            throw new FileNotFoundException($name);
        }
        else
        {
            return unlink($name);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Zip Extract
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $source
    // @param string $target
    //
    //--------------------------------------------------------------------------------------------------------
    public static function zipExtract(String $source, String $target = NULL) : Bool
    {
        $source = Info::rpath($source);
        $target = Info::rpath($target);

        $source = suffix($source, '.zip');

        if( ! file_exists($source) )
        {
            throw new FileNotFoundException($source);
        }

        if( empty($target) )
        {
            $target = Extension::remove($source);
        }

        $zip = new \ZipArchive;

        if( $zip->open($source) === true )
        {
            $zip->extractTo($target);
            $zip->close();

            return true;
        }
        else
        {
            return false;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Create Zip
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $path
    // @param array  $data
    //
    //--------------------------------------------------------------------------------------------------------
    public static function createZip(String $path, Array $data) : Bool
    {
        $path    = Info::rpath($path);
        $zip     = new \ZipArchive;
        $zipPath = suffix($path, ".zip");

        if( file_exists($zipPath) )
        {
            unlink($zipPath);
        }

        if( ! is_dir($pathDirName = Info::pathInfo($path, 'dirname')) )
        {
            mkdir($pathDirName);
        }

        if( $zip->open($zipPath, \ZipArchive::CREATE) !== true )
        {
            return false;
        }

        $status = '';

        if( ! empty($data) ) foreach( $data as $key => $val )
        {
            if( is_numeric($key) )
            {
                $file = $val;
                $fileName = NULL;
            }
            else
            {
                $file = $key;
                $fileName = $val;
            }

            if( is_dir($file) )
            {
                $allFiles = Folder\FileList::allFiles($file, true);

                foreach( $allFiles as $f )
                {
                    $status = $zip->addFile($f, $f);
                }
            }
            else
            {
                $status = $zip->addFile($file, $fileName);
            }
        }

        return $zip->close();
    }

    //--------------------------------------------------------------------------------------------------------
    // Rename
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $oldName
    // @param string $newName
    //
    //--------------------------------------------------------------------------------------------------------
    public static function rename(String $oldName, String $newName) : Bool
    {
        $oldName = Info::rpath($oldName);

        if( ! file_exists($oldName) )
        {
            throw new FileNotFoundException($oldName);
        }

        return rename($oldName, $newName);
    }

    //--------------------------------------------------------------------------------------------------------
    // Clean Cache
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $fileName
    // @param string $real
    //
    //--------------------------------------------------------------------------------------------------------
    public static function cleanCache(String $fileName = NULL, Bool $real = false)
    {
        $fileName = Info::rpath($fileName);

        if( ! file_exists($fileName) )
        {
            clearstatcache($real);
        }
        else
        {
            clearstatcache($real, $fileName);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Truncate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param int    $limit
    // @param string $mode
    //
    //--------------------------------------------------------------------------------------------------------
    public static function truncate(String $file, Int $limit = 0, String $mode = 'r+')
    {
        $file = Info::rpath($file);

        if( ! is_file($file) )
        {
            throw new FileNotFoundException($file);
        }

        $fileOpen  = fopen($file, $mode);
        $fileWrite = ftruncate($fileOpen, $limit);

        fclose($fileOpen);
    }

    //--------------------------------------------------------------------------------------------------------
    // permission()
    //--------------------------------------------------------------------------------------------------------
    //
    // Bir dizin veya dosyaya yetki vermek için kullanılır.
    //
    //--------------------------------------------------------------------------------------------------------
    public static function permission(String $name, Int $permission = 0755) : Bool
    {
        $name = Info::rpath($name);

        if( ! file_exists($name) )
        {
            throw new FileNotFoundException($name);
        }

        return chmod($name, $permission);
    }
}
