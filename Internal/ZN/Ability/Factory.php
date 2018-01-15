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

use ZN\Support;
use ZN\Singleton;

trait Factory
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
        return self::call($method, $parameters);
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
        return $this->call($method, $parameters);
    }

    /**
     * Magic call
     * 
     * @param string $method
     * @param array  $parameters
     * 
     * @return mixed
     */
    public function call($method, $parameters)
    {
        if( ! defined('static::factory') )
        {
            return false;
        }

        $originMethodName = $method;
        $method           = strtolower($method);
        $calledClass      = get_called_class();

        if( ! isset(static::factory['methods'][$method]) )
        {
            Support::classMethod($calledClass, $originMethodName);
        }

        $class   = static::factory['methods'][$method];
        $factory = static::factory['class'] ?? NULL;

        if( $factory !== NULL )
        {
            return $factory::class($class)->$method(...$parameters);
        }
        else
        {
            $classEx = explode('::', $class);
            $class   = $classEx[0] ?? NULL;
            $method  = $classEx[1] ?? NULL;
            $isThis  = NULL;

            if( stristr($method, ':this') )
            {
                $method = str_replace(':this', NULL, $method);
                $isThis = 'this';
            }

            $separator = '\\';
            $namespace = NULL;

            if( strstr($calledClass, $separator) )
            {
                $namespace = explode($separator, $calledClass);
                
                array_pop($namespace);
    
                $namespace = implode($separator, $namespace) . $separator;
            }
            
            $return = Singleton::class($namespace . $class)->$method(...$parameters);

            if( $isThis === 'this' )
            {
                return $this;
            }

            return $return;
        }
    }
}
