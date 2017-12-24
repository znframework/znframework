<?php 
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

trait UnitTestAbility
{
    /**
     * Get result
     * 
     * @param string ...$method
     * 
     * @return string
     */
    public static function result(...$method)
    {
        if( ! defined('static::unit') )
        {
            return false;
        }

        $class   = static::unit['class'];
        $methods = static::unit['methods'];

        if( ! empty($method) )
        {
            $oldMethods = $methods;
            $methods    = [];

            foreach( $method as $met )
            {
                $methods[$met] = $oldMethods[$met];
            }
        }

        Tester::class($class)
              ->methods($methods)
              ->start();

        return Tester::result();
    }
}
