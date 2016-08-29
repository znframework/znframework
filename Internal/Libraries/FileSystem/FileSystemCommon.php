<?php namespace ZN\FileSystem;

use Exceptions, Classes;

class FileSystemCommon implements FileSystemCommonInterface
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

    //--------------------------------------------------------------------------------------------------------
    // Exists
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type
    // @param string $file
    //
    // @param bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function _is($type, $file)
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
}