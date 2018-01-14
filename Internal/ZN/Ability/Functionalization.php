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

trait Functionalization
{
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
        $lower = strtolower($method);
               
        if( $standart = (static::functionalization[$lower] ?? NULL) )
        {
            return $standart(...$parameters);
        }

        if( method_exists(get_parent_class(), '__call'))
        {
            return parent::__call($method, $parameters);
        }
    }
}
