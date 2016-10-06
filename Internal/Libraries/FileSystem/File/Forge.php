<?php namespace ZN\FileSystem\File;

use ZipArchive, Folder, File;
use ZN\FileSystem\Exception\FileNotFoundException;
use ZN\FileSystem\Exception\FileAllreadyException;
use ZN\FileSystem\FileSystemFactory;
use ZN\FileSystem\InternalGenerate;

class Forge implements ForgeInterface
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
    public function generate() : InternalGenerate
    {
        return FileSystemFactory::class('InternalGenerate');
    }

    //--------------------------------------------------------------------------------------------------------
    // Create
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(string $name) : bool
    {
        $name = File::rpath($name);

        if( ! is_file($name) )
        {
            return touch($name);
        }

        throw new FileAllreadyException($name);
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
    public function replace(string $file, $data, $replace) : string
    {
        $file = File::rpath($file);

        if( ! is_file($file))
        {
            throw new FileNotFoundException($file);
        }

        $fileContentClass = Factory::class('Content');
        $contents         = $fileContentClass->read($file);
        $replaceContents  = str_ireplace($data, $replace, $contents);

        if( $contents !== $replaceContents )
        {
            $fileContentClass->write($file, $replaceContents);
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
    public function delete(string $name) : bool
    {
        $name = File::rpath($name);

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
    public function zipExtract(string $source, string $target = NULL) : bool
    {
        $source = File::rpath($source);
        $target = File::rpath($target);

        $source = suffix($source, '.zip');

        if( ! file_exists($source) )
        {
            throw new FileNotFoundException($source);
        }

        if( empty($target) )
        {
            $target = removeExtension($source);
        }

        $zip = new ZipArchive;

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
    public function createZip(string $path, array $data) : bool
    {
        $path    = File::rpath($path);
        $zip     = new ZipArchive();
        $zipPath = suffix($path, ".zip");

        if( file_exists($zipPath) )
        {
            unlink($zipPath);
        }

        if( ! is_dir($pathDirName = pathInfos($path, 'dirname')) )
        {
            Folder::create($pathDirName);
        }

        if( $zip->open($zipPath, ZipArchive::CREATE) !== true )
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
                $allFiles = Folder::allFiles($file, true);

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
    public function rename(string $oldName, string $newName) : bool
    {
        $oldName = File::rpath($oldName);

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
    public function cleanCache( ? string $fileName = NULL, bool $real = false)
    {
        $fileName = File::rpath($fileName);

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
    public function truncate(string $file, int $limit = 0, string $mode = 'r+') : void
    {
        $file = File::rpath($file);

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
    public function permission(string $name, int $permission = 0755) : bool
    {
        $name = File::rpath($name);

        if( ! file_exists($name) )
        {
            throw new FileNotFoundException($name);
        }

        return chmod($name, $permission);
    }
}
