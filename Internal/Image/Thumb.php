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

use ZN\Singleton;

class Thumb implements ThumbInterface
{
    /**
     * Keeps settings
     * 
     * @var array
     */
    protected $sets;

    /**
     * Magic Constructor
     */
    public function __construct()
    {
        $this->image = Singleton::class('ZN\Image\Render');
    }

    /**
     * Sets file path
     * 
     * @param string $file
     * 
     * @return Thumb
     */
    public function path(String $file) : Thumb
    {
        $this->sets['filePath'] = $file;

        return $this;
    }

    /**
     * Sets image quality
     * 
     * @param int $quality
     * 
     * @return Thumb
     */
    public function quality(Int $quality) : Thumb
    {
        $this->sets['quality'] = $quality;

        return $this;
    }

    /**
     * Crop image
     * 
     * @param int $x
     * @param int $y
     * 
     * @return Thumb
     */
    public function crop(Int $x, Int $y) : Thumb
    {
        $this->sets['x'] = $x;
        $this->sets['y'] = $y;

        return $this;
    }

    /**
     * Sets image size
     * 
     * @param int $width
     * @param int $height
     * 
     * @return Thumb
     */
    public function size(Int $width, Int $height) : Thumb
    {
        $this->sets['width']  = $width;
        $this->sets['height'] = $height;

        return $this;
    }

    /**
     * Sets image resize
     * 
     * @param int $width
     * @param int $height
     * 
     * @return Thumb
     */
    public function resize(Int $width, Int $height) : Thumb
    {
        $this->sets['rewidth']  = $width;
        $this->sets['reheight'] = $height;

        return $this;
    }

    /**
     * Sets image proportional size
     * 
     * @param int $width
     * @param int $height
     * 
     * @return Thumb
     */
    public function prosize(Int $width, Int $height = 0) : Thumb
    {
        $this->sets['prowidth']  = $width;
        $this->sets['proheight'] = $height;

        return $this;
    }

    /**
     * Create new image
     * 
     * @param string $path = NULL
     * 
     * @return string
     */
    public function create(String $path = NULL) : String
    {
        if( isset($this->sets['filePath']) )
        {
            $path = $this->sets['filePath'];
        }

        return $this->image->thumb($path, $this->sets);
    }

    /**
     * Get proportional size
     * 
     * @param int $width  = 0
     * @param int $height = 0
     * 
     * @return object|false
     */
    public function getProsize(Int $width = 0, Int $height = 0)
    {
        if( ! isset($this->sets['filePath']) )
        {
            return false;
        }

        return $this->image->getProsize($this->sets['filePath'], $width, $height);
    }
}
