<?php namespace ZN;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Filesystem
{
    /**
     * Create an index.
     * 
     * @param string $file
     * @param int    $permission = 0755
     * @param bool   $recursive  = true
     * 
     * @return bool
     */
    public static function createFolder(String $file, Int $permission = 0755, Bool $recursive = true) : Bool
    {
        if( is_dir($file) )
        {
           return false;
        }

        return mkdir($file, $permission, $recursive);
    }

    /**
     * Remove Extension
     * 
     * @param string $file
     * 
     * @return string
     */
    public static function removeExtension(String $file) : String
    {
        return preg_replace('/\\.[^.\\s]{2,4}$/', '', $file);
    }

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
    public static function getFiles(String $path, $extension = NULL, Bool $pathType = false) : Array
    {
        if( ! is_dir($path) )
        {
            return false;
        }

        if( is_array($extension) )
        {
            $allFiles = [];

            foreach( $extension as $ext )
            {
                $allFiles = array_merge($allFiles, self::_files($path, $ext, $pathType));
            }

            return $allFiles;
        }

        return self::_files($path, $extension, $pathType);
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
    public static function getRecursiveFiles(String $pattern = '*', Bool $allFiles = false) : Array
    {
        // 5.3.36[added]
        if( $pattern === '/' )
        {
            $pattern = '*';
        }

        if( $allFiles === true )
        {
            static $classes;

            if( is_dir($pattern) )
            {
                $pattern = Base::suffix($pattern).'*';
            }

            $files = glob($pattern);

            if( ! empty($files) ) foreach( $files as $v )
            {
                if( is_file($v) )
                {
                    $classEx = explode(DS, $v);

                    $classes[] = $v;
                }
                elseif( is_dir($v) )
                {
                    self::all($v, $allFiles);
                }
            }

            return (array) $classes;
        }

        if( strstr($pattern, DS) && strstr($pattern, '*') === false )
        {
            $pattern .= "*";
        }

        if( strstr($pattern, DS) === false && strstr($pattern, '*') === false )
        {
            $pattern .= DS . "*";
        }

        return glob($pattern);
    }

    /**
     * Protected Files
     */
    protected static function _files($path, $extension, $pathType = false)
    {
        $files = [];

        if( empty($path) )
        {
            $path = '.';
        }

        if( $pathType === true )
        {
            $prefixPath = $path;
        }
        else
        {
            $prefixPath = '';
        }

        $dir = opendir($path);

        while( $file = readdir($dir) )
        {
            if( $file !== '.' && $file !== '..' )
            {
                if( ! empty($extension) && $extension !== 'dir' )
                {
                    if( pathinfo($file, PATHINFO_EXTENSION) === $extension )
                    {
                        $files[] = $prefixPath.$file;
                    }
                }
                else
                {
                    if( $extension === 'dir' )
                    {
                        if( is_dir(Base::suffix($path).$file) )
                        {
                            $files[] = $prefixPath.$file;
                        }
                    }
                    else
                    {
                        $files[] = $prefixPath.$file;
                    }
                }
            }
        }

        return $files;
    }
}
