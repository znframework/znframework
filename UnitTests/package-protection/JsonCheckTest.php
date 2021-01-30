<?php namespace ZN\Protection;

use Json;

class JsonCheckTest extends Test\CommonExtends
{
    public function testCheckTrue()
    {
        $this->assertTrue(Json::check('{"foo":"Foo","bar":"Bar"}'));
    }

    public function testCheckFalse()
    {
        $this->assertFalse(Json::check('{"foo""Foo","bar":"Bar"}'));
    }
}