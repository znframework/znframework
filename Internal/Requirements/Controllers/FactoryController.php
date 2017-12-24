<?php namespace ZN\Requirements\Controllers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class FactoryController extends BaseController
{
    use \MagicFactoryAbility;
}

# Alias FactoryController
class_alias('ZN\Requirements\Controllers\FactoryController', 'FactoryController');
