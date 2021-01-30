<?php namespace ZN\Protection;

use Separator;

class SeparatorReadTest extends Test\CommonExtends
{
    public function testRead()
    {
        $this->assertEquals((object) ['foo' => 'Foo', 'bar' => 'Bar'], Separator::read(self::dir . 'separator'));
    }

    public function testReadObject()
    {
        $this->assertEquals((object) ['foo' => 'Foo', 'bar' => 'Bar'], Separator::readObject(self::dir . 'separator'));
    }

    public function testReadArray()
    {
        $this->assertEquals(['foo' => 'Foo', 'bar' => 'Bar'], Separator::readArray(self::dir . 'separator'));
    }
}