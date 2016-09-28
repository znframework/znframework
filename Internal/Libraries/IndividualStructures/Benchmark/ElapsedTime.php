<?php namespace ZN\IndividualStructures\Benchmark;

class ElapsedTime implements ElapsedTimeInterface
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
    public static function calculate(String $result, Int $decimal = 4) : Float
    {
        $resend  = $result."_end";
        $restart = $result."_start";

        if( ! isset(Properties::$tests[$restart]) )
        {
            throw new BenchmarkException('[Benchmark::elapsedTime(\''.$result.'\')] -> Parameter is not a valid test start!');
        }

        if( ! isset(Properties::$tests[$resend]) )
        {
            throw new BenchmarkException('[Benchmark::elapsedTime(\''.$result.'\')] -> Parameter is not a valid test end!');
        }

        return round((Properties::$tests[$resend] - Properties::$tests[$restart]), $decimal);
    }
}
