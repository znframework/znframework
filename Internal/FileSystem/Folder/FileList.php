<?php namespace ZN\FileSystem\Folder;

use ZN\FileSystem\File;
use ZN\FileSystem\Exception\FolderNotFoundException;

class FileList
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
    // files()
    //--------------------------------------------------------------------------------------------------------
    //
    // Bir dizin içindeki dosya ve dizin listesini almak için kullanılır. Eğer listelenecek dosyalar
    // arasında belli uzantılı dosyaların listelenmesi istenilirse 2. parametreye dosya uzantısı
    // verilebilir. Sadece dizinlerin listelenmesi istenirse 'dir' parametresini kullanmanız gerekir.
    // Birden fazla uzantı belirmek isterseniz 2. parametreyi ['dir', 'php'] gibi belirtebilirsiniz.
    //
    //--------------------------------------------------------------------------------------------------------
    public static function files(String $path, $extension = NULL, Bool $pathType = false) : Array
    {
        $path = File\Info::rpath($path);

        if( ! is_dir($path) )
        {
            throw new FolderNotFoundException($path);
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

    //--------------------------------------------------------------------------------------------------------
    // allFiles() -> 5.3.36[edited]
    //--------------------------------------------------------------------------------------------------------
    //
    // Bir dizine ait tüm alt dizin ve dosyaların listesini almak için kullanılır. İç içe dizinlerde de
    // yer alan dosyaların listelenmesini isterseniz 2. parametreyi true ayarlayabilirsiniz.
    //
    //--------------------------------------------------------------------------------------------------------
    public static function allFiles(String $pattern = '*', Bool $allFiles = false) : Array
    {
        // 5.3.36[added]
        if( $pattern === '/' )
        {
            $pattern = '*';
        }

        $pattern = File\Info::rpath($pattern);

        if( $allFiles === true )
        {
            static $classes;

            if( is_dir($pattern) )
            {
                $pattern = suffix($pattern).'*';
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
                    self::allFiles($v, $allFiles);
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

    //--------------------------------------------------------------------------------------------------------
    // protected _files()
    //--------------------------------------------------------------------------------------------------------
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
                    if( File\Extension::get($file) === $extension )
                    {
                        $files[] = $prefixPath.$file;
                    }
                }
                else
                {
                    if( $extension === 'dir' )
                    {
                        if( is_dir(suffix($path).$file) )
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
