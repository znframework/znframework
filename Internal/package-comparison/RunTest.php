<?php namespace ZN\Comparison;

use Benchmark;

class RunTest extends \PHPUnit\Framework\TestCase
{
    public function testRunBenchmark()
    {
        $result = Benchmark::run(function()
        {
            $var = 10;
        });

        $this->assertIsObject($result->result());
    }
}