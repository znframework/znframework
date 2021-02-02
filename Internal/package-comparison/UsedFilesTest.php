<?php namespace ZN\Comparison;

use Benchmark;

class UsedFilesTest extends \PHPUnit\Framework\TestCase
{
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