<?php namespace ZN\Protection;

use Separator;

class SeparatorTest extends \PHPUnit\Framework\TestCase
{
    const dir = 'UnitTests/package-protection/resources/';

    public function testEncode()
    {
        $this->assertSame('foo+-?||?-+Foo|?-++-?|bar+-?||?-+Bar', Separator::encode(['foo' => 'Foo', 'bar' => 'Bar']));
    }

    public function testDecode()
    {
        $this->assertEquals((object) ['foo' => 'Foo', 'bar' => 'Bar'], Separator::decode('foo+-?||?-+Foo|?-++-?|bar+-?||?-+Bar'));
        $this->assertEquals((object) ['foo' => 'Foo', 'bar' => 'Bar'], Separator::decodeObject('foo+-?||?-+Foo|?-++-?|bar+-?||?-+Bar'));
        $this->assertEquals(['foo' => 'Foo', 'bar' => 'Bar'], Separator::decodeArray('foo+-?||?-+Foo|?-++-?|bar+-?||?-+Bar'));
    }

    public function testWrite()
    {
        Separator::write(self::dir . 'separator', ['foo' => 'Foo', 'bar' => 'Bar']);

        $this->assertFileExists(self::dir . 'separator');
    }

    public function testRead()
    {
        $this->assertEquals((object) ['foo' => 'Foo', 'bar' => 'Bar'], Separator::read(self::dir . 'separator'));
        $this->assertEquals((object) ['foo' => 'Foo', 'bar' => 'Bar'], Separator::readObject(self::dir . 'separator'));
        $this->assertEquals(['foo' => 'Foo', 'bar' => 'Bar'], Separator::readArray(self::dir . 'separator'));
    }
}