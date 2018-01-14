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

trait Serialization
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
        $lower   = strtolower($method);
        $class   = self::serialization['class'];
        $process = (self::serialization['process'] ?? 'serial') === 'serial' ? 'data' : 'return'; 

        if( $lower === self::serialization['start'] )
        {
            $this->data = $parameters[0];
        }
        elseif( $lower === self::serialization['end'] )
        {
            return $this->$process;
        }
        else
        {
            $this->$process = $class::$method($this->data, ...$parameters);
        }

        return $this;
    }
}
