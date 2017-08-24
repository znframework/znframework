<?php namespace ZN\DataTypes;

use Classes;
use ZN\DataTypes\Chars\Exception\UndefinedMethodException;

class InternalChars implements InternalCharsInterface
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

            return $ctype(...$parameters);
        }
        else
        {
            throw new UndefinedMethodException
            (
                'Error',
                'undefinedFunction',
                Classes::onlyName(__CLASS__)."::$method()"
            );
        }
    }
}
