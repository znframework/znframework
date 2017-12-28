<?php namespace ZN\ViewObjects;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Wizard
{
    /**
     * Keeps check.
     * 
     * @var array
     */
    protected $check = ['template', 'view', 'page', 'something'];

    /**
     * Magic call
     * 
     * @param string $method
     * @param array  @parameters
     * 
     * @return string
     */
    public function __call($method, $parameters)
    {   
        $submethod = $parameters[0];

        $submethod($data = new \stdClass);

        preg_match('/\[(\$\w+)\]/', print_r(debug_backtrace()[0]['args'][1][0], true), $match);
  
        $function = ltrim($match[1], '$');

        if( ! in_array($function, $this->check) )
        {
            $function = 'template';
        }

        return \Import::$function($method, (array) $data, $parameters[1] ?? false);
    }
}
