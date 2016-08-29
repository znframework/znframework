<?php namespace ZN\FileSystem;

use Exceptions;

class FileSystemCommon extends \CallController implements FileSystemCommonInterface
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
    // Access
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $access = NULL;

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
    public function access($realPath = true, $parentDirectoryAccess = false) : FileSystemCommon
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
        $config = config('FileSystem', 'file', $this->access);

        $this->access = NULL;

        if( $config['parentDirectoryAccess'] === false )
        {
            $file = str_replace('../', '', $file);
        }

        if( $config['realPath'] === true )
        {
            $file = prefix($file, REAL_BASE_DIR);

        }  

        return $file;
    }

    //--------------------------------------------------------------------------------------------------------
    // Is Available
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    // @param bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function isAvailable(String $file) : Bool
    {
        $file = $this->rpath($file);

        if( file_exists($file) )
        {
            return true;
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------------
    // permission()
    //--------------------------------------------------------------------------------------------------------
    //
    // Bir dizin veya dosyaya yetki vermek için kullanılır.
    //
    //--------------------------------------------------------------------------------------------------------
    public function permission(String $name, Int $permission = 0755) : Bool
    {
        $name = $this->rpath($name);
        
        if( ! file_exists($name) )
        {
            return Exceptions::throws('FileSystem', 'file:notFoundError', $name);
        }

        return chmod($name, $permission);
    }
}