<?php namespace ZN\DataTypes\Arrays;

use Arrays;

class AddElementTest extends \PHPUnit\Framework\TestCase
{
    public function testAddFirst()
    {
        $this->assertSame
        (
            ['baz', 'foo', 'bar'],
            Arrays::addFirst(['foo', 'bar'], 'baz')
        );
    }

    public function testAddFirstMultiple()
    {
        $this->assertSame
        (
            ['baz', 'zoo', 'foo', 'bar'],
            Arrays::addFirst(['foo', 'bar'], ['baz', 'zoo'])
        );
    }

    public function testAddFirstWithKey()
    {
        $this->assertSame
        (
            ['baz' => 'zoo', 'foo', 'bar'],
            Arrays::addFirst(['foo', 'bar'], ['baz' => 'zoo'])
        );
    }

    public function testAddLast()
    {
        $this->assertSame
        (
            ['foo', 'bar', 'baz'],
            Arrays::addLast(['foo', 'bar'], 'baz')
        );
    }

    public function testAddLastMultiple()
    {
        $this->assertSame
        (
            ['foo', 'bar', 'baz', 'zoo'],
            Arrays::addLast(['foo', 'bar'], ['baz', 'zoo'])
        );
    }

    public function testAddLastWithKey()
    {
        $this->assertSame
        (
            ['foo', 'bar', 'baz' => 'zoo'],
            Arrays::addLast(['foo', 'bar'], ['baz' => 'zoo'])
        );
    }
}