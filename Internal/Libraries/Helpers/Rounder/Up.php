<?php namespace ZN\Helpers\Rounder;

use ZN\Helpers\Rounder\Exception\LogicException;

class Up implements CommonInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Up
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $number
    // @param int    $count
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(Float $number, Int $count = 0) : Float
    {
        if( $count === 0 )
        {
            return ceil($number);
        }

        $numbers = explode(".", $number);

        $edit = 0;

        if( ! empty($numbers[1]) )
        {
            $edit = substr($numbers[1], 0, $count);

            return (float) $numbers[0].".".($edit + 1);
        }
        else
        {
            throw new LogicException('[Rounder::up()] -> Decimal values can not be specified for the integer! Check 2.($count) parameter!');
        }
    }
}
