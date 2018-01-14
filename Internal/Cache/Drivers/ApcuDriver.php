<?php namespace ZN\Cache\Drivers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class ApcuDriver extends ApcDriver
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
        $this->apc = 'apcu';

        parent::__construct();
    }
}
