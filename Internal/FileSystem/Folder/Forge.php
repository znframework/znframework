<?php namespace ZN\FileSystem\Folder;

use ZN\FileSystem\File\Info;
use ZN\FileSystem\File\Forge as FileForge;
use ZN\FileSystem\Exception\FolderNotFoundException;

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
    // create()
    //--------------------------------------------------------------------------------------------------------
    //
    // Dizin oluşturmak için kullanılır.
    //
    //--------------------------------------------------------------------------------------------------------
    public static function create(String $file, Int $permission = 0755, Bool $recursive = true) : Bool
    {
        $file = Info::rpath($file);

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
    public static function rename(String $oldName, String $newName) : Bool
    {
        $oldName = Info::rpath($oldName);

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
    public static function deleteEmpty(String $folder) : Bool
    {
        $folder = Info::rpath($folder);

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
    public static function delete(String $name) : Bool
    {
        $name = Info::rpath($name);

        $fileListClass = Factory::class('FileList');

        if( is_file($name) )
        {
            return unlink($name);
        }
        else
        {
            if( ! $fileListClass->files($name) )
            {
                return self::deleteEmpty($name);
            }
            else
            {
                for( $i = 0; $i < count($fileListClass->files($name)); $i++ )
                {
                    foreach( $fileListClass->files($name) as $val )
                    {
                        self::delete($name."/".$val);
                    }
                }
            }

            return self::deleteEmpty($name);
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
    public static function copy(String $source, String $target) : Bool
    {
        $source = Info::rpath($source);
        $target = Info::rpath($target);
        $fileListClass = Factory::class('FileList');

        if( ! file_exists($source) )
        {
            throw new FolderNotFoundException($source);
        }

        if( is_dir($source) )
        {
            if( ! $fileListClass->files($source) )
            {
                $emptyFilePath = suffix($source, DS) . 'empty';

                FileForge::create($emptyFilePath);

                return copy($emptyFilePath, $target);
            }
            else
            {
                if( ! is_dir($target) && ! file_exists($target) )
                {
                    self::create($target);
                }

                if( is_array($fileListClass->files($source)) ) foreach( $fileListClass->files($source) as $val )
                {
                    $sourceDir = $source."/".$val;
                    $targetDir = $target."/".$val;

                    if( is_file($sourceDir) )
                    {
                        copy($sourceDir, $targetDir);
                    }

                    self::copy($sourceDir, $targetDir);
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
    public static function change(String $name) : Bool
    {
        $name = Info::rpath($name);

        if( ! is_dir($name) )
        {
            throw new FolderNotFoundException($name);
        }

        return chdir($name);
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
        return FileForge::permission($name, $permission);
    }
}
