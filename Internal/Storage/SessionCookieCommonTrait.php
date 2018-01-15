<?php namespace ZN\Storage;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\DataTypes\Arrays;
use ZN\DataTypes\Strings;

trait SessionCookieCommonTrait
{
    /**
     * Regenarate session
     * 
     * @var bool
     */
    protected $regenerate = true;

    /**
     * Encode session keys
     * 
     * @var array
     */
    protected $encode = [];

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
        $split = Strings\Split::upperCase($method);

        if( Arrays\GetElement::last($split) === 'Delete' )
        {
            $method = 'delete';

            return $this->delete($split[0]);
        }

        if( $method === 'all' )
        {
            $method = 'selectAll';

            return $this->$method();
        }

        if( $param = ($parameters[0] ?? NULL) )
        {
            return $this->insert($method, $param);
        }

        return $this->select($method);
    }

    /**
     * Encode session key & value
     * 
     * @param string $nameAlgo  = NULL
     * @param string $valueAlgo = NULL
     * 
     * @return $this
     */
    public function encode(String $nameAlgo = NULL, String $valueAlgo = NULL)
    {
        $this->encode['name']  = $nameAlgo;
        $this->encode['value'] = $valueAlgo;

        return $this;
    }

    /**
     * Decode only session key
     * 
     * @param string $nameAlgo
     * 
     * @return $this
     */
    public function decode(String $nameAlgo)
    {
        $this->encode['name'] = $nameAlgo;

        return $this;
    }

    /**
     * Regenerate status
     * 
     * @param bool $regenerate = true
     * 
     * @return $this
     */
    public function regenerate(Bool $regenerate = true)
    {
        $this->regenerate = $regenerate;

        return $this;
    }

    /**
     * protected default variable
     * 
     * @param void
     * 
     * @return void
     */
    protected function defaultVariable()
    {
        $this->name       = NULL;
        $this->value      = NULL;
        $this->encode     = [];
        $this->regenerate = true;
    }
}
