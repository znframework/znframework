<?php namespace ZN\ImageProcessing\Image;

use stdClass;
use ZN\EncodingSupport\ImageProcessing\Image\Exception\ImageNotFoundException;

class CalculateProsize
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
    // Get Prosize
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $path
    // @param int    $width
    // @param int    $height
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(String $path, Int $width = 0, Int $height = 0) : stdClass
    {
        if( ! is_file($path) )
        {
            throw new ImageNotFoundException('[Image::getProsize(\''.$path.'\')] -> Image file is not found!');
        }

        $g = getimagesize($path);
        $x = $g[0]; $y = $g[1];

        if( $width > 0 )
        {
            if( $width <= $x )
            {
                $o = $x / $width;

                $x = $width;

                $y = $y / $o;
            }
            else
            {
                $o = $width / $x;

                $x = $width;

                $y = $y * $o;
            }
        }

        if( $height > 0 )
        {
            if( $height <= $y )
            {
                $o = $y / $height;

                $y = $height;

                $x = $x / $o;
            }
            else
            {
                $o = $height / $y;

                $y = $height;

                $x = $x * $o;
            }
        }

        $array["width"] = round($x); $array["height"] = round($y);

        return (object) $array;
    }
}
