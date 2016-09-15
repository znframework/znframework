<?php namespace ZN\FileSystem\Folder;

use File;
use ZN\FileSystem\Exception\FolderNotFoundException;
use ZN\FileSystem\FolderFactory;
use ZN\FileSystem\FileSystemCommon;

class FolderInfo extends FileSystemCommon
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

        if( is_dir($file) )
        {
            return true;
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------------
    // fileInfo()
    //--------------------------------------------------------------------------------------------------------
    //
    // Bir dosya veya dizine ait dosyalar ve dizinler hakkında çeşitli bilgiler almak için kullanılır.
    //
    //--------------------------------------------------------------------------------------------------------
    public function fileInfo(String $dir, String $extension = NULL) : Array
    {
        $dir = $this->rpath($dir);

        if( is_dir($dir) )
        {
            $files = FolderFactory::class('FolderList')->files($dir, $extension);

            $dir = suffix($dir);

            $filesInfo = [];

            foreach( $files as $file )
            {
                $filesInfo[$file]['basename']   = pathInfos($dir.$file, 'basename');
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
            return (array) File::info($dir);
        }
        else
        {
            throw new FolderNotFoundException($dir);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // disk()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $dir
    // @param string $type = 'free'
    //
    // @return Float
    //
    //--------------------------------------------------------------------------------------------------------
    public function disk(String $dir, String $type = 'free') : Float
    {
        $dir = $this->rpath($dir);

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
}
