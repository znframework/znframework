<?php namespace ZN\Request\Exception;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Abilities\ExclusionAbility;

class InvalidArgumentException extends \InvalidArgumentException
{
    use ExclusionAbility;
}
