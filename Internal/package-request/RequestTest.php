<?php namespace ZN\Request;

use Request;

class RequestTest extends \PHPUnit\Framework\TestCase
{
    public function testRequest()
    {
        Request::example('Example');

        $this->assertEquals('Example', Request::example());
    }

    public function testRequestAll()
    {
        Request::example('Example');

        $this->assertContains('Example', Request::all());
    }
}