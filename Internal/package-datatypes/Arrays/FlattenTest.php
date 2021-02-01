<?php namespace ZN\DataTypes\Arrays;

use Arrays;

class FlattenTest extends \PHPUnit\Framework\TestCase
{
    public function testFlatten()
    {
        $arr = ['foo', ['bar' => 'BAR'], ['baz' => 'BAZ']];

        $return = Arrays::flatten($arr);

        $this->assertSame(['foo', 'bar' => 'BAR', 'baz' => 'BAZ'], $return);
    }

    public function testFlattenPreservedKeyFalse()
    {
        $arr = ['foo', ['bar' => 'BAR'], ['baz' => 'BAZ']];

        $return = Arrays::flatten($arr, false);

        $this->assertSame(['foo', 'BAR', 'BAZ'], $return);
    }
}