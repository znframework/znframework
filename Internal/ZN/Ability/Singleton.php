<?php namespace ZN\Ability;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

trait Singleton
{
    /**
     * singleton
     * 
     * @var self
     * 
     * @return self
     */
    protected static $singleton = NULL;
    
    /**
     * singleton
     * 
     * @param void
     * 
     * @return self
     */
    protected static function singleton()
    {
        if( ! self::$singleton instanceof self ) 
        {
            self::$singleton = new self;
        }

        return self::$singleton;
    }
}
