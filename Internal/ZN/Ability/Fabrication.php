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

trait Fabrication
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
        return $this->call($parameters, $method);
    }

    /**
     * protected call
     * 
     * @param array  $parameters
     * @param string $type = NULL
     * 
     * @return mixed
     */
    protected function call($parameters, $type = NULL)
    {
        $class = (self::fabrication['prefix'] ?? NULL) . $type . (self::fabrication['suffix'] ?? NULL);
        
        return (new $class(...$parameters));
    }
}
