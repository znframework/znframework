<?php namespace ZN\Comparison;

use Benchmark;

class CycleTest extends \PHPUnit\Framework\TestCase
{
    public function testRunBenchmarkCycle()
    {
        $GLOBALS['i'] = 0;
        
        $result = Benchmark::cycle(10, function() use($i)
        {
            $GLOBALS['i']++;
        });

        $this->assertSame(10, $GLOBALS['i']);
    }
}