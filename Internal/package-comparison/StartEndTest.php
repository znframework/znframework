<?php namespace ZN\Comparison;

use Benchmark;

class StartEndTest extends \PHPUnit\Framework\TestCase
{
    public function testRunBenchmarkWithStartAndEnd()
    {
        Benchmark::start('test1');
        $a = 10;
        Benchmark::end('test1');

        $this->assertIsFloat(Benchmark::elapsedTime('test1'));
    }

    public function testRunMultipleBenchmark()
    {
        Benchmark::start('test4');
        for( $i = 1; $i < 1; $i++ )
        {

        }
        Benchmark::end('test4');

        Benchmark::start('test5');
        for( $i = 1; $i < 10000; $i++ )
        {

        }
        Benchmark::end('test5');

        $this->assertTrue(Benchmark::elapsedTime('test4') != Benchmark::elapsedTime('test5'));
    }
}