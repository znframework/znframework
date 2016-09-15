<?php namespace ZN\DataTypes\Arrays;

use ZN\DataTypes\Arrays\Exception\InvalidArgumentException;

class ArrayEach implements ArrayEachInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // each
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array    $array
    // @param callable $callable
    //
    //--------------------------------------------------------------------------------------------------------
    public function each(Array $array, $callable)
    {
        if( ! is_callable($callable) )
        {
            throw new InvalidArgumentException('Error', 'callableParameter', '2.($callable)');
        }

        foreach( $array as $k => $v )
        {
            $callable($v, $k);
        }
    }
}
