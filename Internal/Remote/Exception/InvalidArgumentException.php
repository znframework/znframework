<?php namespace ZN\Remote\Exception;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\ExclusionAbility;

class InvalidArgumentException extends \InvalidArgumentException
{
    use ExclusionAbility;

    const lang =
    [
        'en' => '`%` variable should contain a value!',
        'tr' => '`%` değişkeni bir değer içermelidir!'
    ];
}
