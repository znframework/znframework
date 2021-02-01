<?php namespace ZN\DataTypes\Arrays;

use Arrays;

class RemoveElementTest extends \PHPUnit\Framework\TestCase
{
    public function testRemoveFirst()
    {
        $this->assertSame
        (
            ['bar'],
            Arrays::removeFirst(['foo', 'bar'], 1)
        );
    }

    public function testRemoveLast()
    {
        $this->assertSame
        (
            ['foo'],
            Arrays::removeLast(['foo', 'bar'], 1)
        );
    }

    public function testRemoveKey()
    {
        $this->assertSame
        (
            ['foo', 'bar'],
            Arrays::removeKey(['foo', 'bar', 'zoo' => 'doo'], 'zoo')
        );
    }

    public function testRemoveKeyIndex()
    {
        $this->assertSame
        (
            ['foo', 'bar'],
            Arrays::removeKey(['foo', 'bar', 'doo'], 2)
        );
    }

    public function testRemoveValue()
    {
        $this->assertSame
        (
            [1 => 'bar', 'doo' => 'zoo'],
            Arrays::removeValue(['foo', 'bar', 'doo' => 'zoo'], 'foo')
        );
    }

    public function testRemoveValueWithKey()
    {
        $this->assertSame
        (
            ['foo', 'bar'],
            Arrays::removeValue(['foo', 'bar', 'doo' => 'zoo'], 'zoo')
        );
    }

    public function testRemove()
    {
        $this->assertSame
        (
            ['foo', 'bar'],
            Arrays::remove(['foo', 'bar', 'doo' => 'zoo'], 'doo')
        );
    }

    public function testRemoveValueVariation()
    {
        $this->assertSame
        (
            ['foo', 'bar'],
            Arrays::remove(['foo', 'bar', 'doo' => 'zoo'], [], ['zoo'])
        );
    }

    public function testRemoveKeyValueVariation()
    {
        $this->assertSame
        (
            [1 => 'bar'],
            Arrays::remove(['foo', 'bar', 'doo' => 'zoo'], ['doo'], ['foo'])
        );
    }
    
    public function testDeleteElement()
    {
        $array = Arrays::deleteElement(['foo', 'bar', 'baz', 'zoo' => 'ZOO'], 'baz');

        $this->assertSame
        (
            json_encode(['foo', 'bar', 'zoo' => 'ZOO']), 
            json_encode($array)
        );
    }

    public function testDeleteElementSecondVariation()
    {
        $array = Arrays::deleteElement(['foo', 'bar', 'baz', 'zoo' => 'ZOO'], 'ZOO');

        $this->assertSame
        (
            json_encode(['foo', 'bar', 'baz']), 
            json_encode($array)
        );
    }

    public function testDeleteElementThirdVariation()
    {
        $array = Arrays::deleteElement(['foo', 'bar', 'baz', 'zoo' => 'ZOO'], ['zoo' => 'ZOO']);

        $this->assertSame
        (
            json_encode(['foo', 'bar', 'baz']), 
            json_encode($array)
        );
    }
}