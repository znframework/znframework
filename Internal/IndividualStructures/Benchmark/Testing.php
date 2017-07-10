<?php namespace ZN\IndividualStructures\Benchmark;

class Testing
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
    // Test Start
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $test
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function start(String $test)
    {
        $test = $test."_start";

        Properties::$tests[$test]     = microtime();
        Properties::$usedtests[$test] = get_required_files();
        Properties::$memtests[$test]  = memory_get_usage();
    }

    //--------------------------------------------------------------------------------------------------------
    // Test End
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $test
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function end(String $test)
    {
        $getMemoryUsage = memory_get_usage();
        $test           = $test."_end";

        Properties::$tests[$test]     = microtime();
        Properties::$usedtests[$test] = get_required_files();
        Properties::$memtests[$test]  = $getMemoryUsage;
    }
}
