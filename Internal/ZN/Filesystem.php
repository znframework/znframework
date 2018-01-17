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

use ZN\Exception\FolderNotFoundException;

class Filesystem
{
    /**
     * Performs data modification on the file.
     * 
     * @param string $file
     * @param mixed  $data
     * @param mixed  $replace
     * 
     * @return string
     */
    public static function replaceData(String $file, $data, $replace) : String
    {
        if( ! is_file($file))
        {
            return false;
        }

        $contents         = file_get_contents($file);
        $replaceContents  = str_ireplace($data, $replace, $contents);

        if( $contents !== $replaceContents )
        {
            file_put_contents($file, $replaceContents);
        }

        return $replaceContents;
    }
    
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
     * Used to delete a directory along with its contents.
     * 
     * @param string $name
     * 
     * @return bool
     */
    public static function deleteFolder(String $name) : Bool
    {
        if( is_file($name) )
        {
            return unlink($name);
        }
        else
        {
            $getFiles = self::getFiles($name);

            if( ! empty($getFiles) )
            {
                for( $i = 0; $i < count($getFiles); $i++ )
                {
                    foreach( $getFiles as $val )
                    {
                        self::deleteFolder($name."/".$val);
                    }
                }
            }

            return self::deleteEmptyFolder($name);
        }
    }

    /**
     * Used to delete an empty directory.
     * 
     * @param string $folder
     * 
     * @return bool
     */
    public static function deleteEmptyFolder(String $folder) : Bool
    {
        if( ! is_dir($folder) )
        {
           return false;
        }

        return rmdir($folder);
    }

    /**
     * Creates a file.
     * 
     * @param string $name
     * 
     * @return bool
     */
    public static function createFile(String $name) : Bool
    {
        if( ! is_file($name) )
        {
            return touch($name);
        }

        return false;
    }

    /**
     * Used to copy a directory to another specified location. 
     * This includes other subdirectories and files of the directory to be copied.
     * 
     * @param string $source
     * @param string $target
     * 
     * @return bool
     */
    public static function copy(String $source, String $target) : Bool
    {
        if( ! file_exists($source) )
        {
            throw new FolderNotFoundException($source);
        }

        if( is_dir($source) )
        {
            if( ! self::getFiles($source) )
            {
                $emptyFilePath = Base::suffix($source, DS) . 'empty';

                self::createFile($emptyFilePath);

                return copy($emptyFilePath, $target);
            }
            else
            {
                if( ! is_dir($target) && ! file_exists($target) )
                {
                    self::createFolder($target);
                }

                if( is_array($getFiles = self::getFiles($source)) ) foreach( $getFiles as $val )
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

    /**
     * Get Extension
     * 
     * @param string $file
     * @param bool   $dot = false
     * 
     * @return string
     */
    public static function getExtension(String $file, Bool $dot = false) : String
    {
        $dot = $dot === true ? '.' : '';

        return $dot . strtolower(pathinfo($file, PATHINFO_EXTENSION));
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
                    self::getRecursiveFiles($v, $allFiles);
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
