<?php namespace ZN\Comparison;

use Benchmark;

class MemoryUsageTest extends \PHPUnit\Framework\TestCase
{
    public function testGetMemoryUsage()
    {
        Benchmark::start('test1');
        $a = 10;
        Benchmark::end('test1');

        $this->assertIsInt(Benchmark::memoryUsage('test1'));
    }

    public function testGetMaxMemoryUsage()
    {
        Benchmark::start('test1');
        $a = 10;
        Benchmark::end('test1');

        $this->assertIsInt(Benchmark::maxMemoryUsage('test1'));
    }
}