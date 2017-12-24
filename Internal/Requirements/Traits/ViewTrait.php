<?php namespace Project\Controllers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use Collection;
use Import;

trait ViewTrait
{
    /**
     * Keep data
     * 
     * @var array
     */
    public static $data = [];

    /**
     * Usable methods
     * 
     * @var array
     */
    public static $usableMethods =
    [
        'view', 'script', 'style', 'font', 'template', 'page', 'something', 'theme', 'resource', 'plugin'
    ];

    /**
     * Magic call static
     * 
     * @param string $method
     * @param array  $parameters
     * 
     * @return self
     */
    public static function __callStatic($method, $parameters)
    {
        self::call($method, $parameters);

        return new self;
    }

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
        self::call($method, $parameters);

        return $this;
    }

    /**
     * Get method & parameters
     * 
     * @param string $method
     * @param array  $parameters
     * 
     * @return void
     */
    protected static function call($method, $parameters)
    {
        if( is_scalar($parameters[0]) )
        {
            $ex = explode(':', $parameters[0]);

            if( in_array($met = $ex[0], self::$usableMethods) )
            {
                $pr = Collection::data($parameters)->removeFirst()->addLast(true)->get();

                if( strstr('page|view|something', $met) && ! is_array($pr[0]) )
                {
                    array_unshift($pr, NULL);
                }

                self::$data[$method] = $value = Import::$met($ex[1] ?? NULL, ...$pr);
            }
        }

        if( empty($value) )
        {
            self::$data[$method] = $parameters[0] ?? false;
        }
    }
}
