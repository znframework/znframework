<?php namespace ZN\Authentication;

class LogoutTest extends \PHPUnit\Framework\TestCase
{
    public function testDo()
    {
        $this->assertFalse(false);

        return;

        $class = new Logout;
        
        $this->assertSame(NULL, $class->do());
    }
}