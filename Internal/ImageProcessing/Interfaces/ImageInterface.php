<?php namespace ZN\ImageProcessing;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use stdClass;

interface ImageInterface
{
    //--------------------------------------------------------------------------------------------------------
    // Get Prosize
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $path
    // @param int    $width
    // @param int    $height
    //
    //--------------------------------------------------------------------------------------------------------
    public function getProsize(String $path, Int $width = 0, Int $height = 0) : stdClass;

    //--------------------------------------------------------------------------------------------------------
    // Thumb
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $fpath
    // @param array  $set
    //
    //--------------------------------------------------------------------------------------------------------
    public function thumb(String $fpath, Array $set) : String;
}
