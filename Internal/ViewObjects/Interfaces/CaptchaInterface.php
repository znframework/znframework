<?php namespace ZN\ViewObjects;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

interface CaptchaInterface
{
    /**
     * Adjust the size of the captcha.
     * 
     * @param int $width
     * @param int $height
     * 
     * @return Captcha
     */
    public function size(Int $width, Int $height) : Captcha;

    /**
     * Sets the character width.
     * 
     * @param int $param
     * 
     * @return Captcha
     */
    public function length(Int $param) : Captcha;

    /**
     * Sets the character angle.
     * 
     * @param int $param
     * 
     * @return Captcha
     */
    public function angle(Float $param) : Captcha;

    /**
     * Add ttf fonts.
     * 
     * @param array $fonts
     * 
     * @return Captcha
     */
    public function ttf(Array $fonts) : Captcha;

    /**
     * Sets the border color.
     * 
     * @param string $color = NULL
     * 
     * @return Captcha
     */
    public function borderColor(String $color = NULL) : Captcha;

    /**
     * Sets the background color.
     * 
     * @param string $color = NULL
     * 
     * @return Captcha
     */
    public function bgColor(String $color) : Captcha;

    /**
     * Add background pictures.
     * 
     * @param array $image
     * 
     * @return Captcha
     */
    public function bgImage(Array $image) : Captcha;

    /**
     * Sets the text size.
     * 
     * @param int $size
     * 
     * @return Captcha
     */
    public function textSize(Int $size) : Captcha;

    /**
     * Sets the text coordiante.
     * 
     * @param int $x
     * @param int $y
     * 
     * @return Captcha
     */
    public function textCoordinate(Int $x, Int $y) : Captcha;

    /**
     * Sets the text color.
     * 
     * @param string $color
     * 
     * @return Captcha
     */
    public function textColor(String $color) : Captcha;

    /**
     * Sets the grid color.
     * 
     * @param string $color
     * 
     * @return Captcha
     */
    public function gridColor(String $color = NULL) : Captcha;

    /**
     * Sets the grid space.
     * 
     * @param int $x = 0
     * @param int $y = 0
     * 
     * @return Captcha
     */
    public function gridSpace(Int $x = 0, Int $y = 0) : Captcha;

    /**
     * Completes the captcha creation process.
     * 
     * @param bool  $img     = false
     * @param array $configs = []
     * 
     * @return string
     */
    public function create(Bool $img = false, Array $configs = []) : String;

    /**
     * Returns the current captcha code.
     * 
     * @param void
     * 
     * @return string
     */
    public function getCode() : String;
}
