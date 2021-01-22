<?php namespace ZN\Cache;

class ProcessorTest extends \PHPUnit\Framework\TestCase
{
    public function testRefresh()
    {
        $processor = new Processor;

        $this->assertSame($processor, $processor->refresh());
    }

    public function testData()
    {
        $processor = new Processor;

        $this->assertSame($processor, $processor->data(['a' => 1, 'b' => 2]));
    }

    public function testKey()
    {
        $processor = new Processor;

        $this->assertSame($processor, $processor->key('a'));
    }

    public function testCode()
    {
        $processor = new Processor;

        $this->assertIsString($processor->code(function()
        {
            echo 10;
        }));
    }

    public function testView()
    {
        $processor = new Processor;

        $this->assertEmpty($processor->view('example'));
    }

    public function testFile()
    {
        $processor = new Processor;

        $this->assertIsString($processor->file('zeroneed.php'));
    }

    public function testSelect()
    {
        $processor = new Processor;

        $processor->insert('a', 1);

        $this->assertSame(1, $processor->select('a'));
    }

    public function testInsert()
    {
        $processor = new Processor;

        $this->assertSame(true, $processor->insert('a', 1));
    }

    public function testDelete()
    {
        $processor = new Processor;

        $this->assertSame(true, $processor->delete('a'));

        $this->assertSame(false, $processor->delete('x'));
    }

    public function testIncrement()
    {
        $processor = new Processor;

        $this->assertIsInt($processor->increment('a'));
    }

    public function testDecrement()
    {
        $processor = new Processor;

        $this->assertIsInt($processor->decrement('a'));
    }

    public function testInfo()
    {
        $processor = new Processor;

        $this->assertIsArray($processor->info());
    }

    public function testGetMetaData()
    {
        $processor = new Processor;

        $this->assertIsArray($processor->getMetaData('a'));
    }

    public function testClean()
    {
        $processor = new Processor;

        $this->assertTrue($processor->clean());
    }
}