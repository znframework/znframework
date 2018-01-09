<?php namespace ZN\ErrorHandling;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use Exception;
use ZN\Abilities\ExclusionAbility;

class GeneralException extends Exception implements GeneralExceptionInterface
{
    use ExclusionAbility;
}

class_alias('ZN\ErrorHandling\GeneralException', 'GeneralException');