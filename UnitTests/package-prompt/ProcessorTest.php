<?php namespace ZN\Prompt;

use Processor;

class ProcessorTest extends \PHPUnit\Framework\TestCase
{
    public function testExec()
    {
        $this->assertIsString(Processor::exec('php -v'));
    }

    public function testShell()
    {
        $this->assertIsString(Processor::driver('shell')->exec('php -v'));

    }

    public function testSystem()
    {
        $this->assertIsString(Processor::driver('system')->exec('php -v'));
    }

    public function testOutput()
    {
        $this->assertIsArray(Processor::output());
    }

    public function testSSH()
    {
        try
        {
            $this->assertIsString(Processor::driver('ssh')->exec('php -v'));
        }
        catch(\ZN\Exception $e)
        {
            $this->assertStringContainsString('SSH(Secure Shell)', $e->getMessage());
        }
    }
}