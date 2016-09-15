<?php namespace ZN\FileSystem\File;

use ZN\FileSystem\Exception\FileNotFoundException;
use ZN\FileSystem\FileSystemCommon;

class FileRequire extends FileSystemCommon
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
    // Require
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    // @return array
    //
    //--------------------------------------------------------------------------------------------------------
    public function require(String $file, String $type = 'require')
    {
        $file = $this->rpath($file);

        if( ! is_file($file) )
        {
            throw new FileNotFoundException($file);
        }

        switch( $type )
        {
            case 'require':
                return require $file;
            break;

            case 'require_once':
                return require_once $file;
            break;

            case 'include':
                return include $file;
            break;

            case 'include_once':
                return include_once $file;
            break;
        }
    }
}
