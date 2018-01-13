<?php namespace ZN\Commands;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use Crontab;

class RemoveCron
{
    /**
     * Magic constructor
     * 
     * @param array $parameters
     * 
     * @return void
     */
    public function __construct($parameters)
    {   
        echo Crontab::remove($parameters ?? NULL);
    }
}