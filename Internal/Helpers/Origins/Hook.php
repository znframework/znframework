<?php namespace ZN\Helpers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Hook
{
    public function __call($method, $parameters)
    {
        $hook = \Config::hooks();

        return $hook[$method](...$parameters) ?? false;
    }
}
