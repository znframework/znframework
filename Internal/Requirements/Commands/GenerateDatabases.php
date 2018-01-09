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

use Generate;

class GenerateDatabases
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
        new Result(Generate::databases());
    }
}