<?php namespace ZN;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Chars
{
    /**
     * Keeps methods
     * 
     * @var array
     */
    protected static $methods =
    [
        'isalnum'    => 'alnum',
        'isalpha'    => 'alpha',
        'isnumeric'  => 'digit',
        'isgraph'    => 'graph',
        'islower'    => 'lower',
        'isupper'    => 'upper',
        'isprint'    => 'print',
        'isnonalnum' => 'punct',
        'isspace'    => 'space',
        'ishex'      => 'xdigit',
        'iscontrol'  => 'cntrl'
    ];

    /**
     * Magic call static 
     * 
     * @param string $method
     * @param array  $parameters
     * 
     * @return bool
     */
    public static function __callStatic($method, $parameters)
    {
        $method = strtolower($method);

        if( isset(self::$methods[$method]) )
        {
            $ctype = 'ctype_'.self::$methods[$method];

            return $ctype((string) $parameters[0]);
        }
        else
        {
            Support::classMethod(__CLASS__, $method);
        }
    }
}

class_alias('ZN\Chars', 'Chars');