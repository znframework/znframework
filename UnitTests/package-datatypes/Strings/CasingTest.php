<?php namespace ZN\DataTypes\Strings;

use Strings;

class CasingTest extends \PHPUnit\Framework\TestCase
{
    public function testCasing()
    {
        $this->assertSame('FOO', Strings::casing('foo', 'upper'));
        $this->assertSame('foo', Strings::casing('FOO', 'lower'));
        $this->assertSame('Foo', Strings::casing('FOO', 'title'));
    }

    public function testUpperCase()
    {
        $this->assertSame('FOO', Strings::upperCase('foo'));
    }

    public function testLowerCase()
    {
        $this->assertSame('foo', Strings::lowerCase('FOO'));
    }

    public function testTitleCase()
    {
        $this->assertSame('Foo', Strings::titleCase('FOO'));
    }

    public function testPascalCase()
    {
        $this->assertSame('FooBarBaz', Strings::pascalCase('Foo BAR baz'));
    }

    public function testCamelCase()
    {
        $this->assertSame('fooBarBaz', Strings::camelCase('Foo BAR baz'));
    }
}