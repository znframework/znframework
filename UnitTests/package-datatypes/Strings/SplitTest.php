<?php namespace ZN\DataTypes\Strings;

use Strings;

class SplitTest extends \PHPUnit\Framework\TestCase
{
    public function testSplit()
    {
        $this->assertSame(['foo', 'bar', 'baz'], Strings::split('foobarbaz', 3));
    }

    public function testSplitUpperCase()
    {
        $this->assertSame(['Foo', 'Bar', 'Baz'], Strings::splitUpperCase('FooBarBaz'));
    }

    public function testSplitDivide()
    {
        $this->assertSame('', Strings::divide('/foo/bar/baz/', '/'));
        $this->assertSame('foo', Strings::divide('foo/bar/baz/', '/'));
        $this->assertSame('bar', Strings::divide('foo/bar/baz/', '/', 1));
        $this->assertSame('baz', Strings::divide('foo/bar/baz', '/', -1));
        $this->assertSame('', Strings::divide('foo/bar/baz/', '/', -1));
        $this->assertSame('foo/bar', Strings::divide('foo/bar/baz', '/', 0, 2));
        $this->assertSame('bar/baz', Strings::divide('foo/bar/baz', '/', -2, 2));
        $this->assertSame('bar/baz', Strings::divide('foo/bar/baz', '/', 1, 2));
    }
}