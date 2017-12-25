<?php namespace ZN\Requirements\System;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Factory
{
    use \FactoryAbility;
}

# Alias Factory
class_alias('ZN\Requirements\System\Factory', 'Factory');
