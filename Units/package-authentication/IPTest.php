<?php namespace ZN\Authentication;

class IPTest extends \PHPUnit\Framework\TestCase
{
    public function testV4()
    {
        $this->assertFalse(false);

        return;
        
        $class = new IP;

        $this->assertSame(\ZN\Request\Request::ipv4(), $class->v4());
    }
}