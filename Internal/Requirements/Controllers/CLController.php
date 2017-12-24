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

class CLController extends BaseController
{
    use \ConfigurableAbility, \ConversationAbility;

    /**
     * Magic constructor
     * 
     * @param void
     * 
     * @return void
     */
    public function __construct()
    {
        $this->configurable();
        $this->conversation();
    }
}

# Alias CLController
class_alias('ZN\Requirements\Controllers\CLController', 'CLController');
