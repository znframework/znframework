<?php namespace ZN\Protection;

use Json;

class JsonDecodeTest extends Test\CommonExtends
{
    public function testDecode()
    {
        $this->assertEquals((object) ['foo' => 'Foo', 'bar' => 'Bar'], Json::decode('{"foo":"Foo","bar":"Bar"}'));
    }

    public function testDecodeObject()
    {
        $this->assertEquals((object) ['foo' => 'Foo', 'bar' => 'Bar'], Json::decodeObject('{"foo":"Foo","bar":"Bar"}'));
    }

    public function testDecodeArray()
    {
        $this->assertEquals(['foo' => 'Foo', 'bar' => 'Bar'], Json::decodeArray('{"foo":"Foo","bar":"Bar"}'));
    }
}