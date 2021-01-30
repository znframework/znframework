<?php namespace ZN\Protection;

use Serial;

class SerialDecodeTest extends Test\CommonExtends
{
    public function testDecode()
    {
        $this->assertEquals((object) ['foo' => 'Foo', 'bar' => 'Bar'], Serial::decode('a:2:{s:3:"foo";s:3:"Foo";s:3:"bar";s:3:"Bar";}'));
    }

    public function testDecodeObject()
    {
        $this->assertEquals((object) ['foo' => 'Foo', 'bar' => 'Bar'], Serial::decodeObject('a:2:{s:3:"foo";s:3:"Foo";s:3:"bar";s:3:"Bar";}'));
    }

    public function testDecodeArray()
    {
        $this->assertEquals(['foo' => 'Foo', 'bar' => 'Bar'], Serial::decodeArray('a:2:{s:3:"foo";s:3:"Foo";s:3:"bar";s:3:"Bar";}'));
    }
}