<?php namespace ZN\FileSystem\File;

use File;
use ZN\FileSystem\Exception\FileNotFoundException;

class Loader implements LoaderInterface
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
        $file = File::rpath($file);

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

    //--------------------------------------------------------------------------------------------------------
    // Require Once
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    // @return array
    //
    //--------------------------------------------------------------------------------------------------------
    public function requireOnce(String $file)
    {
        return $this->require($file, 'require_once');
    }

    //--------------------------------------------------------------------------------------------------------
    // Include
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    // @return array
    //
    //--------------------------------------------------------------------------------------------------------
    public function include(String $file)
    {
        return $this->require($file, 'include');
    }

    //--------------------------------------------------------------------------------------------------------
    // Include Once
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    // @return array
    //
    //--------------------------------------------------------------------------------------------------------
    public function includeOnce(String $file)
    {
        return $this->require($file, 'include_once');
    }
}
