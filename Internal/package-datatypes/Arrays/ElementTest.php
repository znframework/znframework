<?php namespace ZN\DataTypes\Arrays;

use Arrays;

class ElementTest extends \PHPUnit\Framework\TestCase
{
    public function testKeyvalOnlyValue()
    {
        $return = Arrays::keyval(['foo', 'bar'], 'value');

        $this->assertSame('foo', $return);
    }

    public function testKeyvalOnlyKey()
    {
        $return = Arrays::keyval(['foo', 'bar'], 'key');

        $this->assertSame(0, $return);
    }

    public function testKeyvalValues()
    {
        $return = Arrays::keyval(['foo', 'bar'], 'values');

        $this->assertSame(['foo', 'bar'], $return);
    }

    public function testKeyvalKeys()
    {
        $return = Arrays::keyval(['foo', 'bar'], 'keys');

        $this->assertSame([0, 1], $return);
    }

    public function testValue()
    {
        $return = Arrays::value(['foo', 'bar']);

        $this->assertSame('foo', $return);
    }

    public function testKey()
    {
        $return = Arrays::key(['foo', 'bar']);

        $this->assertSame(0, $return);
    }

    public function testValues()
    {
        $return = Arrays::values(['foo', 'bar']);

        $this->assertSame(['foo', 'bar'], $return);
    }

    public function testKeys()
    {
        $return = Arrays::keys(['foo', 'bar']);

        $this->assertSame([0, 1], $return);
    }

    public function testMultikey()
    {
        $return = Arrays::multikey(['foo|bar|baz' => 'MOO']);

        $this->assertSame(['foo' => 'MOO', 'bar' => 'MOO', 'baz' => 'MOO'], $return);
    }

    public function testLength()
    {
        $return = Arrays::length(['foo', 'bar', 'baz' => 'MOO']);

        $this->assertSame(3, $return);
    }
}