<?php namespace ZN\Captcha;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

interface RenderInterface
{
    /**
     * Adjust the size of the captcha.
     * 
     * @param int $width
     * @param int $height
     * 
     * @return Captcha
     */
    public function size(Int $width, Int $height) : Render;

    /**
     * Sets the character width.
     * 
     * @param int $param
     * 
     * @return Captcha
     */
    public function length(Int $param) : Render;

    /**
     * Sets the character angle.
     * 
     * @param int $param
     * 
     * @return Captcha
     */
    public function angle(Float $param) : Render;

    /**
     * Add ttf fonts.
     * 
     * @param array $fonts
     * 
     * @return Captcha
     */
    public function ttf(Array $fonts) : Render;

    /**
     * Sets the border color.
     * 
     * @param string $color = NULL
     * 
     * @return Captcha
     */
    public function borderColor(String $color = NULL) : Render;

    /**
     * Sets the background color.
     * 
     * @param string $color = NULL
     * 
     * @return Captcha
     */
    public function bgColor(String $color) : Render;

    /**
     * Add background pictures.
     * 
     * @param array $image
     * 
     * @return Captcha
     */
    public function bgImage(Array $image) : Render;

    /**
     * Sets the text size.
     * 
     * @param int $size
     * 
     * @return Captcha
     */
    public function textSize(Int $size) : Render;

    /**
     * Sets the text coordiante.
     * 
     * @param int $x
     * @param int $y
     * 
     * @return Captcha
     */
    public function textCoordinate(Int $x, Int $y) : Render;

    /**
     * Sets the text color.
     * 
     * @param string $color
     * 
     * @return Captcha
     */
    public function textColor(String $color) : Render;

    /**
     * Sets the grid color.
     * 
     * @param string $color
     * 
     * @return Captcha
     */
    public function gridColor(String $color = NULL) : Render;

    /**
     * Sets the grid space.
     * 
     * @param int $x = 0
     * @param int $y = 0
     * 
     * @return Captcha
     */
    public function gridSpace(Int $x = 0, Int $y = 0) : Render;

    /**
     * Completes the captcha creation process.
     * 
     * @param bool $img = false
     * 
     * @return string
     */
    public function create(Bool $img = false) : String;

    /**
     * Returns the current captcha code.
     * 
     * @param void
     * 
     * @return string
     */
    public function getCode() : String;
}
