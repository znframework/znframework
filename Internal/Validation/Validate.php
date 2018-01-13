<?php namespace ZN\Validation;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Validate implements ValidateInterface
{
    /**
     * Keeps data.
     * 
     * @var string
     */
    protected $data = NULL;

    /**
     * Keeps status.
     * 
     * @var array
     */
    protected $status = [];

    /**
     * Magic call
     * 
     * @param string $method
     * @param array  $parameters
     * 
     * @return $this
     */
    public function __call($method, $parameters)
    {
        $this->status[$method] = Validator::$method($this->data, ...$parameters);

        return $this;
    }

    /**
     * Get data.
     * 
     * @param string $data
     * 
     * @return Validate
     */
    public function data(String $data) : Validate
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get result
     * 
     * @param void
     * 
     * @return bool
     */
    public function get() : Bool
    {
        $this->data = NULL;

        foreach( $this->status as $method => $state )
        {
            if( $state === false )
            {
                return false;
            }
        }

        return true;
    }

    /**
     * Get status.
     * 
     * @param void
     * 
     * @return array
     */
    public function status() : Array
    {
        return $this->status;
    }
}
