<?php namespace ZN\Buffering;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Singleton as Single;

class Singleton
{
    /**
     * Keep session library
     * 
     * @var ZN\Storage\Session
     */
    protected static $session;

    /**
     * Magic construct
     * 
     * @param void
     * 
     * @return void
     */
    public function __construct()
    {
        self::$session = Single::class('ZN\Storage\Session');
    }
}
