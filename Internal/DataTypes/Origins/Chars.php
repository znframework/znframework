<?php namespace ZN\DataTypes;

use Classes;
use ZN\IndividualStructures\Support;

class Chars
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

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
