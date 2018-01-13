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

class CaptchaUnitTest extends \UnitTestController
{
    const unit =
    [
        'class'   => 'Captcha',
        'methods' => 
        [
            'create'        => [true],
            'getCode'       => []
        ]
    ];
}
