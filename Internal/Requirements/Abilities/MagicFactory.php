<?php 

use ZN\IndividualStructures\Support;

trait MagicFactoryAbility
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Golden
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    public function __call($method, $parameters)
    {
        if( ! defined('static::factory') )
        {
            return false;
        }

        $originMethodName = $method;
        $method           = Autoloader::lower($method);
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
            
            $return = uselib($namespace . $class)->$method(...$parameters);

            if( $isThis === 'this' )
            {
                return $this;
            }

            return $return;
        }
    }
}
