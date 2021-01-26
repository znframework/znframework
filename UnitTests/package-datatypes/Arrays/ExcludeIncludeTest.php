<?php namespace ZN\DataTypes;

use Arrays;

class ExcludeIncludeTest extends \PHPUnit\Framework\TestCase
{
    public function testExclude()
    {
        $array = ['foo', 'bar', 'baz' => 'BAZ', 'zoo' => 'ZOO', 'doo'];

        $array = Arrays::exclude($array, ['bar', 'BAZ', 'zoo']);

        $this->assertSame(['foo', 2 => 'doo'], $array);
    }

    public function testInclude()
    {
        $array = ['foo', 'bar', 'baz' => 'BAZ', 'zoo' => 'ZOO', 'doo'];

        $array = Arrays::include($array, ['bar', 'BAZ', 'zoo']);

        $this->assertSame([1 => 'bar', 'baz' => 'BAZ', 'zoo' => 'ZOO'], $array);
    }
}