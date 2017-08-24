<?php namespace ZN\IndividualStructures\Buffer;

use ZN\IndividualStructures\Buffer\Exception\InvalidArgumentException;

class File
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
    // File
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $file
    // @return content
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do(String $file) : String
    {
        if( ! is_file($file) )
        {
            throw new InvalidArgumentException('Error', 'fileParameter', '1.($file)');
        }

        ob_start();

        require($file);

        $contents = ob_get_contents();

        ob_end_clean();

        return $contents;
    }
}
