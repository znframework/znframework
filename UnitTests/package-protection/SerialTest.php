<?php namespace ZN\Protection;

use Serial;

class SerialTest extends \PHPUnit\Framework\TestCase
{
    const dir = 'UnitTests/package-protection/resources/';

    public function testEncode()
    {
        $this->assertSame('a:2:{s:3:"foo";s:3:"Foo";s:3:"bar";s:3:"Bar";}', Serial::encode(['foo' => 'Foo', 'bar' => 'Bar']));
    }

    public function testDecode()
    {
        $this->assertEquals((object) ['foo' => 'Foo', 'bar' => 'Bar'], Serial::decode('a:2:{s:3:"foo";s:3:"Foo";s:3:"bar";s:3:"Bar";}'));
        $this->assertEquals((object) ['foo' => 'Foo', 'bar' => 'Bar'], Serial::decodeObject('a:2:{s:3:"foo";s:3:"Foo";s:3:"bar";s:3:"Bar";}'));
        $this->assertEquals(['foo' => 'Foo', 'bar' => 'Bar'], Serial::decodeArray('a:2:{s:3:"foo";s:3:"Foo";s:3:"bar";s:3:"Bar";}'));
    }

    public function testWrite()
    {
        Serial::write(self::dir . 'serial', ['foo' => 'Foo', 'bar' => 'Bar']);

        $this->assertFileExists(self::dir . 'serial');
    }

    public function testRead()
    {
        $this->assertEquals((object) ['foo' => 'Foo', 'bar' => 'Bar'], Serial::read(self::dir . 'serial'));
        $this->assertEquals((object) ['foo' => 'Foo', 'bar' => 'Bar'], Serial::readObject(self::dir . 'serial'));
        $this->assertEquals(['foo' => 'Foo', 'bar' => 'Bar'], Serial::readArray(self::dir . 'serial'));
    }
}