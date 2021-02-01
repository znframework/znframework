<?php namespace ZN\Protection;

use Separator;

class SeparatorDecodeTest extends Test\CommonExtends
{
    public function testDecode()
    {
        $this->assertEquals((object) ['foo' => 'Foo', 'bar' => 'Bar'], Separator::decode('foo+-?||?-+Foo|?-++-?|bar+-?||?-+Bar'));
    }

    public function testDecodeObject()
    {
        $this->assertEquals((object) ['foo' => 'Foo', 'bar' => 'Bar'], Separator::decodeObject('foo+-?||?-+Foo|?-++-?|bar+-?||?-+Bar'));
    }

    public function testDecodeArray()
    {
        $this->assertEquals(['foo' => 'Foo', 'bar' => 'Bar'], Separator::decodeArray('foo+-?||?-+Foo|?-++-?|bar+-?||?-+Bar'));
    }
}