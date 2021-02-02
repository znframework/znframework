<?php namespace ZN\Comparison;

use Benchmark;

class ElapsedTimeTest extends \PHPUnit\Framework\TestCase
{
    public function testGetElapsedTime()
    {
        Benchmark::start('test1');
        $a = 10;
        Benchmark::end('test1');

        $this->assertIsFloat(Benchmark::elapsedTime('test1'));
    }
}