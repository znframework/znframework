<?php namespace ZN\IndividualStructures\Benchmark;

interface ElapsedTimeInterface
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
    // Elapsed Time
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $result
    // @param  numeric $decimal
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public static function calculate(String $result, Int $decimal = 4) : Float;
}
