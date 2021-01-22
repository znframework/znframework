<?php namespace ZN\Authentication;

class LogoutTest extends \PHPUnit\Framework\TestCase
{
    public function testDo()
    {
        $class = new Logout;
        
        $this->assertSame(NULL, $class->do());
    }
}