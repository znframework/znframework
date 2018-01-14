<?php namespace ZN;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\UnitTestAbility;

class UnitTestController
{
    use UnitTestAbility;
}

# Alias UnitTestController
class_alias('ZN\UnitTestController', 'UnitTestController');
