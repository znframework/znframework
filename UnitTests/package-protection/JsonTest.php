<?php namespace ZN\Protection;

use Json;

class JsonTest extends \PHPUnit\Framework\TestCase
{
    const dir = 'UnitTests/package-protection/resources/';

    public function testEncode()
    {
        $this->assertSame('{"foo":"Foo","bar":"Bar"}', Json::encode(['foo' => 'Foo', 'bar' => 'Bar']));
    }

    public function testDecode()
    {
        $this->assertEquals((object) ['foo' => 'Foo', 'bar' => 'Bar'], Json::decode('{"foo":"Foo","bar":"Bar"}'));
        $this->assertEquals((object) ['foo' => 'Foo', 'bar' => 'Bar'], Json::decodeObject('{"foo":"Foo","bar":"Bar"}'));
        $this->assertEquals(['foo' => 'Foo', 'bar' => 'Bar'], Json::decodeArray('{"foo":"Foo","bar":"Bar"}'));
    }

    public function testWrite()
    {
        Json::write(self::dir . 'example', ['foo' => 'Foo', 'bar' => 'Bar']);

        $this->assertFileExists(self::dir . 'example.json');
    }

    public function testRead()
    {
        $this->assertEquals((object) ['foo' => 'Foo', 'bar' => 'Bar'], Json::read(self::dir . 'example'));
        $this->assertEquals((object) ['foo' => 'Foo', 'bar' => 'Bar'], Json::readObject(self::dir . 'example'));
        $this->assertEquals(['foo' => 'Foo', 'bar' => 'Bar'], Json::readArray(self::dir . 'example'));
    }

    public function testCheck()
    {
        $this->assertTrue(Json::check('{"foo":"Foo","bar":"Bar"}'));
        $this->assertFalse(Json::check('{"foo""Foo","bar":"Bar"}'));
    }

    public function testError()
    {
        Json::check('{"foo""Foo","bar":"Bar"}');

        $this->assertEquals('Syntax error', Json::error());
    }
}