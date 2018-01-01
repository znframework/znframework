<?php namespace ZN\FileSystem\Folder;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\FileSystem\Exception\FolderNotFoundException;
use ZN\FileSystem\File;
use ZN\FileSystem\Folder;

class Info
{
    //--------------------------------------------------------------------------------------------------------
    // basePath()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public static function basePath() : String
    {
        return getcwd();
    }

    //--------------------------------------------------------------------------------------------------------
    // Exists
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    // @param bool
    //
    //--------------------------------------------------------------------------------------------------------
    public static function exists(String $file) : Bool
    {
        $file = File\Info::rpath($file);

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
    public static function fileInfo(String $dir, String $extension = NULL) : Array
    {
        $dir = File\Info::rpath($dir);

        if( is_dir($dir) )
        {
            $files = Folder\FileList::files($dir, $extension);

            $dir = suffix($dir);

            $filesInfo = [];

            foreach( $files as $file )
            {
                $filesInfo[$file]['basename']   = File\Info::pathInfo($dir.$file, 'basename');
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
            return (array) File\Info::get($dir);
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
    public static function disk(String $dir, String $type = 'free') : Float
    {
        $dir = File\Info::rpath($dir);

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

    //--------------------------------------------------------------------------------------------------------
    // totalSpace()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $dir
    //
    // @return Float
    //
    //--------------------------------------------------------------------------------------------------------
    public static function totalSpace(String $dir) : Float
    {
        return self::disk($dir, 'total');
    }

    //--------------------------------------------------------------------------------------------------------
    // freeSpace()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $dir
    //
    // @return Float
    //
    //--------------------------------------------------------------------------------------------------------
    public static function freeSpace(String $dir) : Float
    {
        return self::disk($dir, 'free');
    }
}
