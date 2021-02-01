<?php namespace ZN\Protection;

use Serial;

class SerialReadTest extends Test\CommonExtends
{
    public function testRead()
    {
        $this->assertEquals((object) ['foo' => 'Foo', 'bar' => 'Bar'], Serial::read(self::dir . 'serial'));
    }

    public function testReadObject()
    {
        $this->assertEquals((object) ['foo' => 'Foo', 'bar' => 'Bar'], Serial::readObject(self::dir . 'serial'));
    }

    public function testReadArray()
    {
        $this->assertEquals(['foo' => 'Foo', 'bar' => 'Bar'], Serial::readArray(self::dir . 'serial'));
    }
}