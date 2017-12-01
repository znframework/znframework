<?php namespace ZN\DataTypes\XML;

use ZN\DataTypes\Exception\FileNotFoundException;

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

        if( is_file($file) )
        {
            return file_get_contents($file);
        }
        else
        {
            throw new FileNotFoundException('Exception', 'fileNotFound', $file);
        }
    }
}
