<?php namespace ZN\Prompt;

use Processor;
use ZN\Exception;

class SSHTest extends \PHPUnit\Framework\TestCase
{
    public function testSSH()
    {
        try
        {
            $this->assertIsString(Processor::driver('ssh')->exec('php -v'));
        }
        catch( Exception $e )
        {
            $this->assertStringContainsString('SSH(Secure Shell)', $e->getMessage());
        }
    }
}