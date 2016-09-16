<?php namespace ZN\IndividualStructures\Benchmark;

class MemoryUsage
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
    // Calculated Memory
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $result
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function calculate(String $result) : Int
    {
        $resend  = $result."_end";
        $restart = $result."_start";

        if( isset(Properties::$memtests[$resend]) && isset(Properties::$memtests[$restart]) )
        {
            $calc = Properties::$memtests[$resend] - Properties::$memtests[$restart];

            return $calc;
        }
        else
        {
            return false;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Memory Usage
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  bool $realMemory
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function normal(Bool $realMemory = false) : Int
    {
        return  memory_get_usage($realMemory);
    }

    //--------------------------------------------------------------------------------------------------------
    // Max Memory Usage
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  bool $realMemory
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function maximum(Bool $realMemory = false) : Int
    {
        return  memory_get_peak_usage($realMemory);
    }
}
