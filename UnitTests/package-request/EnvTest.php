<?php namespace ZN\Request;

use Env;

class EnvTest extends \PHPUnit\Framework\TestCase
{
    public function testEnv()
    {
        Env::example('Example');

        $this->assertEquals('Example', Env::example());
    }

    public function testEnvAll()
    {
        Env::example('Example');

        $this->assertContains('Example', Env::all());
    }
}