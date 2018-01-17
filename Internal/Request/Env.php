<?php namespace ZN\Request;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Env
{
    /**
     * Magic Call Static
     * 
     * @param string $method
     * @param array  $parameters
     * 
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        if( $method === 'all' )
        {
            return Method::env();
        }

        return Method::env($method, $parameters[0] ?? NULL);
    }
}

class_alias('ZN\Request\Env', 'Env');