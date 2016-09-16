<?php namespace ZN\DataTypes\XML;

use File;
use ZN\DataTypes\XML\Exception\FileNotFoundException;

class Loader implements LoaderInterface
{
    //--------------------------------------------------------------------------------------------------------
    // Load
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string   $file
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(String $file) : String
    {
        $file = suffix($file, '.xml');

        if( File::exists($file) )
        {
            return File::read($file);
        }
        else
        {
            throw new FileNotFoundException('Exception', 'fileNotFound', $file);
        }
    }
}
