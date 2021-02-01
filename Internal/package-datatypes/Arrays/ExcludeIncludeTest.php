<?php namespace ZN\DataTypes\Arrays;

use Arrays;

class ExcludeIncludeTest extends \PHPUnit\Framework\TestCase
{
    public function testExclude()
    {
        $array = ['foo', 'bar', 'baz' => 'BAZ', 'zoo' => 'ZOO', 'doo'];

        $array = Arrays::exclude($array, ['bar', 'BAZ', 'zoo']);

        $this->assertIsArray($array);
    }

    public function testInclude()
    {
        $array = ['foo', 'bar', 'baz' => 'BAZ', 'zoo' => 'ZOO', 'doo'];

        $array = Arrays::include($array, ['bar', 'BAZ', 'zoo']);

        $this->assertIsArray($array);
    }
}