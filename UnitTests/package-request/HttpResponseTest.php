<?php namespace ZN\Request;

use Http;

class HttpResponseTest extends \PHPUnit\Framework\TestCase
{
    public function testResponse()
    {
        Http::response(401);
    }

    public function testResponsePermanently()
    {
        Http::response(301);
    }
}