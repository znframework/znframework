<?php namespace ZN\FileSystem;

class InternalFile extends \CallController implements FileInterface
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
    // Read
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function read(String $file) : String
    {
        return file_get_contents($file);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Contents
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function contents(String $file) : String
    {
        return file_get_contents($file);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Find
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function find(String $file, String $data) : \stdClass
    {
        $index    = strpos(file_get_contents($file), $data);    
        $contents = $this->contents($file);
    
        return (object)
        [
            'index'    => $index,
            'contents' => $contents
        ];  
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Write
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function write(String $file, String $data) : Int
    {
        return file_put_contents($file, $data);
    }   
    
    //--------------------------------------------------------------------------------------------------------
    // Append
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function append(String $file, String $data) : Int
    {
        return file_put_contents($file, $data, FILE_APPEND);
    }   
    
    //--------------------------------------------------------------------------------------------------------
    // Create
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(String $name) : Bool
    {
        if( ! is_file($name) )
        { 
            return touch($name);
        }
        
        return \Exceptions::throws('FileSystem', 'file:alreadyFileError', $name);   
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Delete
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    //
    //--------------------------------------------------------------------------------------------------------
    public function delete(String $name) : Bool
    {
        if( ! is_file($name)) 
        {
            return \Exceptions::throws('FileSystem', 'file:notFoundError', $name);  
        }
        else 
        {
            return unlink($name);   
        }
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
        if( ! is_file($file) )
        {
            return \Exceptions::throws('FileSystem', 'file:notFoundError', $file);
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
        if( ! file_exists($file) )
        {
            return \Exceptions::throws('FileSystem', 'file:notFoundError', $file);
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
            $folderFiles = \Folder::files($file);
            
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
        if( ! file_exists($file) )
        {
            return \Exceptions::throws('FileSystem', 'file:notFoundError', $file);
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
        if( ! file_exists($file) )
        {
            return \Exceptions::throws('FileSystem', 'file:notFoundError', $file);
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
        if( function_exists('posix_getpwuid') )
        {
            posix_getpwuid(fileowner($file));
        }
        else
        {
            return fileowner($file);
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
        if( ! file_exists($file) )
        {
            return \Exceptions::throws('FileSystem', 'file:notFoundError', $file);
        }
        
        if( function_exists('posix_getgrgid') )
        {
            posix_getgrgid(filegroup($file));
        }
        else
        {
            return filegroup($file);
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
    public function zipExtract(String $source, String $target = NULL) : Bool
    {
        $source = suffix($source, '.zip');

        if( ! file_exists($source) )
        {
            return \Exceptions::throws('FileSystem', 'file:notFoundError', $source);
        }

        if( empty($target) )
        {
            $target = removeExtension($source); 
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
    public function createZip(String $path, Array $data) : Bool
    {           
        $zip = new \ZipArchive();

        $zipPath = suffix($path, ".zip");
        
        if( file_exists($zipPath) ) 
        {   
            unlink($zipPath);   
        }

        if( $zip->open($zipPath, \ZIPARCHIVE::CREATE) !== true ) 
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
                $allFiles = \Folder::allFiles($file, true);
                
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
    public function rename(String $oldName, String $newName) : String
    {
        if( ! file_exists($oldName) )
        {
            return \Exceptions::throws('FileSystem', 'file:notFoundError', $oldName);
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
    public function cleanCache(String $fileName = NULL, Bool $real = false)
    {
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
    // Permission
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param int    $permission
    //
    //--------------------------------------------------------------------------------------------------------
    public function permission(String $file, Int $permission = 0755) : Bool
    {
        if( ! file_exists($file) )
        {
            return \Exceptions::throws('FileSystem', 'file:notFoundError', $file);
        }
        
        return chmod($file, $permission);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Limit
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param int    $limit
    // @param string $mode
    //
    //--------------------------------------------------------------------------------------------------------
    public function limit(String $file, Int $limit = 0, String $mode = 'r+')
    {
        if( ! is_file($file) )
        {
            return \Exceptions::throws('FileSystem', 'file:notFoundError', $file);
        }
    
        $fileOpen  = fopen($file, $mode);
        $fileWrite = ftruncate($fileOpen, $limit);
        
        fclose($fileOpen);
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
        if( ! file_exists($file) )
        {
            return \Exceptions::throws('FileSystem', 'file:notFoundError', $file);
        }

        if( is_file($file) )
        {
            return count( file($file) );
        }
        elseif( is_dir($file) )
        {
            $files =  \Folder::allFiles($file, $recursive);
            
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