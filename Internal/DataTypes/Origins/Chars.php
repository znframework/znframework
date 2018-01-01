<?php namespace ZN\DataTypes;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use Classes;
use ZN\IndividualStructures\Support;

class Chars
{
    protected $methods =
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

    //--------------------------------------------------------------------------------------------------------
    // Magic Call
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    public function __call($method, $parameters)
    {
        $method = strtolower($method);

        if( isset($this->methods[$method]) )
        {
            $ctype = 'ctype_'.$this->methods[$method];

            return $ctype((string) $parameters[0]);
        }
        else
        {
            Support::classMethod(__CLASS__, $method);
        }
    }
}
