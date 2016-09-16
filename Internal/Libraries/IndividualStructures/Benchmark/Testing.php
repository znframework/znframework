<?php namespace ZN\IndividualStructures\Benchmark;

class Testing
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
    // Test Start
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $test
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    public function start(String $test)
    {
        Properties::$testCount++;

        $legancy = ( Properties::$testCount === 1 )
                   ? $legancy = 136
                   : 48;

        $test = $test."_start";

        Properties::$tests[$test]     = microtime();
        Properties::$usedtests[$test] = get_required_files();
        Properties::$memtests[$test]  = memory_get_usage() + $legancy;
    }

    //--------------------------------------------------------------------------------------------------------
    // Test End
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $test
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    public function end(String $test)
    {
        $test = $test."_end";

        Properties::$memtests[$test]  = memory_get_usage();
        Properties::$usedtests[$test] = get_required_files();
        Properties::$tests[$test]     = microtime();
    }
}
