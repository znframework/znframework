<?php namespace ZN\Comparison;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Testing
{
    /**
     * Start test
     * 
     * @param string $test
     * 
     * @return void
     */
    public static function start(String $test)
    {
        $test = $test."_start";

        Properties::$tests[$test]     = microtime(true);
        Properties::$usedtests[$test] = get_required_files();
        Properties::$memtests[$test]  = memory_get_usage();
    }

    /**
     * End test
     * 
     * @param string $test
     * 
     * @return void
     */
    public static function end(String $test)
    {
        $getMemoryUsage = memory_get_usage();
        $test           = $test."_end";

        Properties::$tests[$test]     = microtime(true);
        Properties::$usedtests[$test] = get_required_files();
        Properties::$memtests[$test]  = $getMemoryUsage;
    }
}
