<?php namespace ZN\Authorization;

class ProcessTest extends \PHPUnit\Framework\TestCase
{
    public function testStartAndEnd()
    {
        $class = new Process;

        $class->start(1, 'delete');

        $this->assertTrue(true);

        $class->end();

        $this->assertFalse(false);
    }
}