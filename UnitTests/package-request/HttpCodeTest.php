<?php namespace ZN\Request;

use Http;

class HttpCodeTest extends \PHPUnit\Framework\TestCase
{
    public function testCode()
    {
        $this->assertEquals('100 Continue', Http::code(100));
    }

    public function testCodeOK()
    {
        $this->assertEquals('200 OK', Http::code(200));
    }
}