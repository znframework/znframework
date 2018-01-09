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

use Cache;

class CleanCache
{
    /**
     * Magic constructor
     * 
     * @param 
     * 
     * @return void
     */
    public function __construct()
    {   
        new Result(Cache::clean());
    }
}