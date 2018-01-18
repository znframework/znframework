<?php namespace ZN\Routing;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

trait PropertyCreatorTrait
{
    public function __call($method, $parameters)
    {
        $this->filters[strtolower($method)] = $parameters[0] ?? true;

        return $this;
    }
}
