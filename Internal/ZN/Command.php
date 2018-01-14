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

use ZN\Exception;
use ZN\BaseController;

class Command extends BaseController
{
    /**
     * Magic constructor
     * 
     * @param void
     * 
     * @return void
     */
    public function __construct()
    {
        if( server('documentRoot') )
        {
            throw new Exception
            (
                'Commands',
                'canNotCommandClass'
            );
        }
    }
}

class_alias('ZN\Command', 'Project\Commands\Command');