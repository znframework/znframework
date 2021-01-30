<?php namespace ZN\Prompt;

use Processor;

class ShellTest extends \PHPUnit\Framework\TestCase
{
    public function testShell()
    {
        $this->assertIsString(Processor::driver('shell')->exec('php -v'));

    }
}