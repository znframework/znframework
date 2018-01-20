<?php namespace ZN\Image;
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

interface RenderInterface
{
    /**
     * Get prosize
     * 
     * @param string $path
     * @param int    $width = 0
     * @param int    $height = 0
     * 
     * @return object
     */
    public function getProsize(String $path, Int $width = 0, Int $height = 0) : stdClass;

    /**
     * Thumb
     * 
     * @param string $fpath
     * @param array  $set
     * 
     * @return string
     */
    public function thumb(String $fpath, Array $set) : String;
}
