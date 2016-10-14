<?php namespace ZN\ImageProcessing\Image;

interface CalculateProsizeInterface
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
    public function do(String $path, Int $width = 0, Int $height = 0) : \stdClass;
}
