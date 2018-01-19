<?php namespace ZN\Email\Exception;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Ability\Exclusion;

class InvalidCharsetException extends \InvalidArgumentException
{
    use Exclusion;

    const lang = 
    [
        'en' => '`%` invalid character set!',
        'tr' => '`%` geçersiz karakter seti!'
    ];
}
