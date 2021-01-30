<?php namespace ZN\Prompt;

use Processor;

class ExecTest extends \PHPUnit\Framework\TestCase
{
    public function testExec()
    {
        $this->assertIsString(Processor::exec('php -v'));
    }
}