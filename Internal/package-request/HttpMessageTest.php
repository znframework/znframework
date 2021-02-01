<?php namespace ZN\Request;

use Http;

class HttpMessageTest extends \PHPUnit\Framework\TestCase
{
    public function testMessage()
    {
        $this->assertEquals('100 Continue', Http::message('continue'));
    }

    public function testMessageOK()
    {
        $this->assertEquals('200 OK', Http::message('ok'));
    }
}