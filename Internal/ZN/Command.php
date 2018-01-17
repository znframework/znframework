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

class Command extends Base
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
        if( $_SERVER['DOCUMENT_ROOT'] ?? NULL )
        {
            throw new Exception
            (
                'Commands',
                'canNotCommandClass'
            );
        }
    }
}
