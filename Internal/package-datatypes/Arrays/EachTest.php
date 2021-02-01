<?php namespace ZN\DataTypes\Arrays;

use Arrays;

class EachTest extends \PHPUnit\Framework\TestCase
{
    public function testGetFirst()
    {
        $array = [];

        Arrays::each(['foo', 'bar'], function($value, $key) use(&$array)
        {
            $array[$value] = $key;
        });

        $this->assertSame(['foo' => 0, 'bar' => 1], $array);
    }
}