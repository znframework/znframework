<?php namespace ZN\Filesystem;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Filesystem;
use ZN\Filesystem\Exception\FolderNotFoundException;

class FileList
{
    /**
     * Used to retrieve a list of files and directories within a directory.
     * If it is desired to list files with a certain extension between the files to be listed, 
     * the file extension for the second parameter can be used.
     * 
     * @param string $path
     * @param mixed  $extension = NULL
     * @param bool   $pathType  = false
     * 
     * @return array
     */
    public static function files(String $path, $extension = NULL, Bool $pathType = false) : Array
    {
        $path = Info::rpath($path);

        if( ! is_dir($path) )
        {
            throw new FolderNotFoundException($path);
        }

        return Filesystem::getFiles($path, $extension, $pathType);
    }

    /**
     * Used to retrieve a list of all subdirectories and files belonging to a directory. 
     * You can set the second parameter to true 
     * if you want to list the files that are also in the nested indexes.
     * 
     * @param string $pattern  = '*'
     * @param bool   $allFiles = false
     * 
     * @return array
     */
    public static function allFiles(String $pattern = '*', Bool $allFiles = false) : Array
    {
        return Filesystem::getRecursiveFiles($pattern, $allFiles);
    }
}
