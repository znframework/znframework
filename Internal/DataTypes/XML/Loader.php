<?php namespace ZN\DataTypes\XML;

use ZN\DataTypes\XML\Exception\FileNotFoundException;
use ZN\FileSystem\File;

class Loader
{
    //--------------------------------------------------------------------------------------------------------
    // Load
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string   $file
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do(String $file) : String
    {
        $file = suffix($file, '.xml');

        if( File\Info::exists($file) )
        {
            return File\Content::read($file);
        }
        else
        {
            throw new FileNotFoundException('Exception', 'fileNotFound', $file);
        }
    }
}
