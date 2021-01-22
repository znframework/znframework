<?php namespace ZN\Authentication;

class AgentTest extends \PHPUnit\Framework\TestCase
{
    public function testGet()
    {
        $this->assertSame($_SERVER['HTTP_USER_AGENT'] ?? '', Agent::get());
    }
}