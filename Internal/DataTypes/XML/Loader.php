<?php namespace ZN\DataTypes\XML;

use ZN\DataTypes\XML\Exception\FileNotFoundException;
use ZN\FileSystem\File\Content;
use ZN\FileSystem\File\Info;

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

        if( Info::exists($file) )
        {
            return Content::read($file);
        }
        else
        {
            throw new FileNotFoundException('Exception', 'fileNotFound', $file);
        }
    }
}
