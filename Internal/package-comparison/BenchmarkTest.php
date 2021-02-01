<?php namespace ZN\Comparison;

use Benchmark;

class BenchmarkTest extends \PHPUnit\Framework\TestCase
{
    public function testRunBenchmark()
    {
        $result = Benchmark::run(function()
        {
            $var = 10;
        });

        $this->assertIsObject($result->result());
    }

    public function testRunBenchmarkWithStartAndEnd()
    {
        Benchmark::start('test1');
        $a = 10;
        Benchmark::end('test1');

        $this->assertIsFloat(Benchmark::elapsedTime('test1'));
    }

    public function testRunBenchmarkCycle()
    {
        $GLOBALS['i'] = 0;
        
        $result = Benchmark::cycle(10, function() use($i)
        {
            $GLOBALS['i']++;
        });

        $this->assertSame(10, $GLOBALS['i']);
    }

    public function testGetElapsedTime()
    {
        Benchmark::start('test1');
        $a = 10;
        Benchmark::end('test1');

        $this->assertIsFloat(Benchmark::elapsedTime('test1'));
    }

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

    public function testGetUsedFiles()
    {
        Benchmark::start('test');
        
        \Encode::super('test');

        Benchmark::end('test');

        $this->assertIsArray(Benchmark::usedFiles('test'));
    }

    public function testGetUsedFileCount()
    {
        Benchmark::start('test');
        
        \Encode::super('test');

        Benchmark::end('test');

        $this->assertIsInt(Benchmark::usedFileCount('test'));
    }
}