<?php namespace ZN\Prompt;

use Processor;

class SystemTest extends \PHPUnit\Framework\TestCase
{
    public function testSystem()
    {
        $this->assertIsString(Processor::driver('system')->exec('php -v'));
    }

    public function testOutput()
    {
        $this->assertIsArray(Processor::output());
    }
}