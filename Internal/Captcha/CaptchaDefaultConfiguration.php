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

/**
 * Default Cookie Configuration
 * 
 * Enabled when the configuration file can not be accessed.
 */
class CaptchaDefaultConfiguration
{
    /*
    |--------------------------------------------------------------------------
    | Captcha
    |--------------------------------------------------------------------------
    |
    | Includes default settings for the captcha.
    |
    */

    public $text =
    [
        'length' => 6,
        'color'  => '255|255|255',
        'size'   => 10,
        'x'      => 65,
        'y'      => 13,
        'angle'  => 0,
        'ttf'    => []
    ];
    public $background =
    [
        'color' => '80|80|80',
        'image' => []
    ];
    public $border =
    [
        'status' => false,
        'color'  => '0|0|0'
    ];
    public $size =
    [
        'width'  => 180,
        'height' => 40
    ];
    public $grid =
    [
        'status' => true,
        'color'  => '50|50|50',
        'spaceX' => 12,
        'spaceY' => 4
    ];
}
