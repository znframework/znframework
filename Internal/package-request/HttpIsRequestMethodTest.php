<?php namespace ZN\Request;

use Http;
use Post;

class HttpIsRequestMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testIsRequestMethod()
    {
        $_SERVER['REQUEST_METHOD'] = 'post';

        $this->assertTrue(Http::isRequestMethod('post'));
    }

    public function testIsRequestMethodGetControl()
    {
        $_SERVER['REQUEST_METHOD'] = 'get';

        $this->assertTrue(Http::isRequestMethod('get'));
    }
}