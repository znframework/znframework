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

trait Revolving
{
    /**
     * Get revolving values
     * 
     * @var array
     */
    protected $revolvings;

    /**
     * Magic call
     * 
     * @param string $method
     * @param array  $param
     * 
     * @return $this
     */
    public function __call($method, $param)
    {   
        $this->$method = (count($param ?? NULL) > 1) ? $param : ($param[0] ?? NULL);
        
        $this->revolvings[$method] = $this->$method;

        return $this;
    }

    /**
     * Magic call static
     * 
     * @param string $method
     * @param array  $param
     * 
     * @return self
     */
    public static function __callStatic($method, $param)
    {
        return (new self)->__call($method, $param);
    }

    /**
     * Default variables
     * 
     * @param string $type = 'all'
     * 
     * @return void
     */
    protected function defaultVariables($type = 'all')
    {
        $vars = $type === 'all' 
              ? get_class_vars(get_called_class())
              : $this->revolvings;        

        foreach( $vars as $key => $var )
        {
            $this->$key = NULL;
        }
    }

    /**
     * Default revolving variables
     * 
     * @param void
     * 
     * @return void
     */
    protected function defaultRevolvingVariables()
    {
        $this->defaultRevolvings('revolving');
    }
}
