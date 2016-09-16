<?php namespace ZN\IndividualStructures\Benchmark;

class ElapsedTime
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
    // Elapsed Time
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $result
    // @param  numeric $decimal
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function calculate(String $result, Int $decimal = 4) : Float
    {
        $resend  = $result."_end";
        $restart = $result."_start";

        if( isset(Properties::$tests[$resend]) && isset(Properties::$tests[$restart]) )
        {
            return round((Properties::$tests[$resend] - Properties::$tests[$restart]), $decimal);
        }
        else
        {
            return false;
        }
    }
}
