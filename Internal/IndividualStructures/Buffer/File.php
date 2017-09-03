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
    // File -> 5.3.2[edited]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $file
    // @param  array  $data
    // @return content
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do(String $file, Array $data = NULL) : String
    {
        if( ! is_file($file) )
        {
            throw new InvalidArgumentException('Error', 'fileParameter', '1.($file)');
        }

        // 5.3.2[added]
        if( is_array($data) )
        {
            extract($data, EXTR_OVERWRITE, 'ZN');
        }

        ob_start();

        require($file);

        $contents = ob_get_contents();

        ob_end_clean();

        return $contents;
    }
}
