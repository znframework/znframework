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
use ZN\Structure;
use ZN\IS;

class Cron
{
    /**
     * Magic constructor
     * 
     * @param string $command
     * @param array  $parameters
     * 
     * @return void
     */
    public function __construct($command, $parameters)
    {   
        for( $index = 0, $rindex = 1; $index < count($parameters); $index += 2, $rindex += 2 )
        {
            $func = $parameters[$index]  ?? NULL;
            $prm  = $parameters[$rindex] ?? NULL;
            Crontab::$func($prm);
        }
        
        if( IS::url($command) ) # wget
        {
            echo Crontab::wget($command);
        }
        elseif( strstr($command, '/') )
        {
            echo Crontab::controller($command); # controller
        }
        else
        {
            echo Crontab::command($command); # command
        }
    }
}