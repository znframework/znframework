<?php namespace ZN\ImageProcessing;

use CallController;

class InternalImage extends CallController implements InternalImageInterface
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
    // Thumb
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $fpath
    // @param array  $set
    //
    //--------------------------------------------------------------------------------------------------------
    public function thumb(String $fpath, Array $set) : String
    {
        return ImageFactory::class('RenderImage')->do($fpath, $set);
    }

    //--------------------------------------------------------------------------------------------------------
    // Get Prosize
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $path
    // @param int    $width
    // @param int    $height
    //
    //--------------------------------------------------------------------------------------------------------
    public function getProsize(String $path, Int $width = 0, Int $height = 0) : \stdClass
    {
        return ImageFactory::class('CalculateProsize')->do($path, $width, $height);
    }
}
