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

use ZN\Singleton;

trait Facade
{
    /**
     * Magic call static
     * 
     * @param string $method
     * @param array  $parameters
     * 
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        return self::useClassName($method, $parameters);
    }

    /**
     * Magic call
     * 
     * @param string $method
     * @param array  $parameters
     * 
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return self::useClassName($method, $parameters);
    }

   /**
     * Use class name
     * 
     * @param string $method
     * @param array  $parameters
     * 
     * @return mixed
     */
    protected static function useClassName($method, $parameters)
    {
        return Singleton::class(static::target)->$method(...$parameters);
    }
}
