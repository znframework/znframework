<?php namespace ZN\DataTypes\Arrays;

use Arrays;

class ColumnTest extends \PHPUnit\Framework\TestCase
{
    public function testColumn()
    {
        $arr = 
        [
            ['id' => 13, 'firstName' => 'Foo', 'lastName' => 'FOO'],
            ['id' => 29, 'firstName' => 'Bar', 'lastName' => 'BAR']
        ];

        $return = Arrays::column($arr, 'firstName');

        $this->assertSame(['Foo', 'Bar'], $return);
    }

    public function testColumnWithIndex()
    {
        $arr = 
        [
            ['id' => 13, 'firstName' => 'Foo', 'lastName' => 'FOO'],
            ['id' => 29, 'firstName' => 'Bar', 'lastName' => 'BAR']
        ];

        $return = Arrays::column($arr, 'firstName', 'lastName');

        $this->assertSame(['FOO' => 'Foo', 'BAR' => 'Bar'], $return);
    }
}