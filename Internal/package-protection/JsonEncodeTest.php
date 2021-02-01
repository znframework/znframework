<?php namespace ZN\Protection;

use Json;

class JsonEncodeTest extends Test\CommonExtends
{
    public function testEncode()
    {
        $this->assertSame('{"foo":"Foo","bar":"Bar"}', Json::encode(['foo' => 'Foo', 'bar' => 'Bar']));
    }
}