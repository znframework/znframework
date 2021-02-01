<?php namespace ZN\Protection;

use Serial;

class SerialEncodeTest extends Test\CommonExtends
{
    public function testEncode()
    {
        $this->assertSame('a:2:{s:3:"foo";s:3:"Foo";s:3:"bar";s:3:"Bar";}', Serial::encode(['foo' => 'Foo', 'bar' => 'Bar']));
    }
}