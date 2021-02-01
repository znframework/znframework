<?php namespace ZN\Protection;

use Json;

class JsonErrorTest extends Test\CommonExtends
{
    public function testError()
    {
        Json::check('{"foo""Foo","bar":"Bar"}');

        $this->assertEquals('Syntax error', Json::error());
    }
}