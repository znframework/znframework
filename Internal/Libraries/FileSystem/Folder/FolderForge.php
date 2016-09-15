<?php namespace ZN\FileSystem\Folder;

use ZN\FileSystem\Exception\FolderNotFoundException;
use ZN\FileSystem\FolderFactory;
use ZN\FileSystem\FileSystemCommon;

class FolderForge extends FileSystemCommon
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
    // create()
    //--------------------------------------------------------------------------------------------------------
    //
    // Dizin oluşturmak için kullanılır.
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(String $file, Int $permission = 0755, Bool $recursive = true) : Bool
    {
        $file = $this->rpath($file);

        if( is_dir($file) )
        {
           return false;
        }

        return mkdir($file, $permission, $recursive);
    }

    //--------------------------------------------------------------------------------------------------------
    // rename()
    //--------------------------------------------------------------------------------------------------------
    //
    // Dosya veya dizinin adını değiştirmek için kullanılır.
    //
    //--------------------------------------------------------------------------------------------------------
    public function rename(String $oldName, String $newName) : Bool
    {
        $oldName = $this->rpath($oldName);

        if( ! file_exists($oldName) )
        {
            throw new FolderNotFoundException($oldName);
        }

        return rename($oldName, $newName);
    }

    //--------------------------------------------------------------------------------------------------------
    // deleteEmpty()
    //--------------------------------------------------------------------------------------------------------
    //
    // Boş bir dizini silmek için kullanılır.
    //
    //--------------------------------------------------------------------------------------------------------
    public function deleteEmpty(String $folder) : Bool
    {
        $folder = $this->rpath($folder);

        if( ! is_dir($folder) )
        {
           return false;
        }

        return rmdir($folder);
    }

    //--------------------------------------------------------------------------------------------------------
    // delete()
    //--------------------------------------------------------------------------------------------------------
    //
    // Bir dizini içindekilerle birlikte silmek için kullanılır.
    //
    //--------------------------------------------------------------------------------------------------------
    public function delete(String $name) : Bool
    {
        $name = $this->rpath($name);

        $fileListClass = FolderFactory::class('FolderList');

        if( is_file($name) )
        {
            return unlink($name);
        }
        else
        {
            if( ! $fileListClass->files($name) )
            {
                return $this->deleteEmpty($name);
            }
            else
            {
                for( $i = 0; $i < count($fileListClass->files($name)); $i++ )
                {
                    foreach( $fileListClass->files($name) as $val )
                    {
                        $this->delete($name."/".$val);
                    }
                }
            }

            return $this->deleteEmpty($name);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Copy()
    //--------------------------------------------------------------------------------------------------------
    //
    // Bir dizini belirtilen başka bir konuma kopyalamak için kullanılır. Bu işlem kopyalanacak dizine
    // ait diğer alt dizin ve dosyaları da kapsamaktadır.
    //
    //--------------------------------------------------------------------------------------------------------
    public function copy(String $source, String $target) : Bool
    {
        $source = $this->rpath($source);
        $target = $this->rpath($target);
        $fileListClass = FolderFactory::class('FolderList');

        if( ! file_exists($source) )
        {
            throw new FolderNotFoundException($source);
        }

        if( is_dir($source) )
        {
            if( ! $fileListClass->files($source) )
            {
                return copy($source, $target);
            }
            else
            {
                if( ! is_dir($target) && ! file_exists($target) )
                {
                    $this->create($target);
                }

                if( is_array($fileListClass->files($source)) ) foreach( $fileListClass->files($source) as $val )
                {
                    $sourceDir = $source."/".$val;
                    $targetDir = $target."/".$val;

                    if( is_file($sourceDir) )
                    {
                        copy($sourceDir, $targetDir);
                    }

                    $this->copy($sourceDir, $targetDir);
                }

                return true;
            }
        }
        else
        {
            return copy($source, $target);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // change()
    //--------------------------------------------------------------------------------------------------------
    //
    // PHP'nin aktif çalışma dizinini değiştirmek için kullanılır.
    //
    //--------------------------------------------------------------------------------------------------------
    public function change(String $name) : Bool
    {
        $name = $this->rpath($name);

        if( ! is_dir($name) )
        {
            throw new FolderNotFoundException($name);
        }

        return chdir($name);
    }
}
