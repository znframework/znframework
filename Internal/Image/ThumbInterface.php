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

interface ThumbInterface
{
    /**
     * Sets file path
     * 
     * @param string $file
     * 
     * @return Thumb
     */
    public function path(String $file) : Thumb;

    /**
     * Sets image quality
     * 
     * @param int $quality
     * 
     * @return Thumb
     */
    public function quality(Int $quality) : Thumb;

    /**
     * Crop image
     * 
     * @param int $x
     * @param int $y
     * 
     * @return Thumb
     */
    public function crop(Int $x, Int $y) : Thumb;

    /**
     * Sets image size
     * 
     * @param int $width
     * @param int $height
     * 
     * @return Thumb
     */
    public function size(Int $width, Int $height) : Thumb;

    /**
     * Sets image resize
     * 
     * @param int $width
     * @param int $height
     * 
     * @return Thumb
     */
    public function resize(Int $width, Int $height) : Thumb;

    /**
     * Sets image proportional size
     * 
     * @param int $width
     * @param int $height
     * 
     * @return Thumb
     */
    public function prosize(Int $width, Int $height = 0) : Thumb;

    /**
     * Create new image
     * 
     * @param string $path = NULL
     * 
     * @return string
     */
    public function create(String $path) : String;

    /**
     * Get proportional size
     * 
     * @param int $width  = 0
     * @param int $height = 0
     * 
     * @return object|false
     */
    public function getProsize(Int $width, Int $height);
}
