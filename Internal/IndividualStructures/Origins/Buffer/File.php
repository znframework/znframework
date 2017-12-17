<?php namespace ZN\IndividualStructures\Buffer;

use ZN\IndividualStructures\Exception\InvalidArgumentException;

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
    public static function do(String $randomBufferClassPagePath, Array $randomBufferClassDataVariable = NULL) : String
    {
        if( ! is_file($randomBufferClassPagePath) )
        {
            throw new InvalidArgumentException('Error', 'fileParameter', '1.($file)');
        }

        if( is_array($randomBufferClassDataVariable) )
        {
            extract($randomBufferClassDataVariable, EXTR_OVERWRITE, 'ZN');
        }

        ob_start();

        require $randomBufferClassPagePath;

        $randomBufferClassPageContents = ob_get_contents();

        ob_end_clean();

        return $randomBufferClassPageContents;
    }
}
