<?php namespace ZN\DataTypes\Arrays;

use Arrays;

class SortTest extends \PHPUnit\Framework\TestCase
{
    public function testOrder()
    {
        $array = Arrays::order(['foo', 'bar', 'baz'], 'desc');

        $this->assertSame([0 => 'foo', 2 => 'baz', 1 => 'bar'], $array);
    }

    public function testSortRegular()
    {
        $array = Arrays::sort(['foo', 'bar', 'baz', 1, 2, 3, 11, 12, 13]);

        $this->assertIsArray($array);
    }

    public function testSortNumeric()
    {
        $array = Arrays::sort(['foo', 'bar', 'baz', 1, 2, 3, 11, 12, 13]);

        $this->assertIsArray($array);
    }

    public function testSortString()
    {
        $array = Arrays::sort(['foo', 'bar', 'baz', 1, 2, 3, 11, 12, 13], 'string');

        $this->assertSame([1, 11, 12, 13, 2, 3, 'bar', 'baz', 'foo'], $array);
    }

    public function testSortLocalString()
    {
        $array = Arrays::sort(['a', 'b', 'c', 'ç', 'd'], 'string');

        $this->assertSame(['a', 'b', 'c', 'd', 'ç'], $array);
    }

    public function testDescending()
    {
        $array = Arrays::descending(['foo', 'bar', 'baz', 1, 2, 3, 11, 12, 13]);

        $this->assertIsArray($array);
    }

    public function testAscending()
    {
        $array = Arrays::ascending(['foo', 'bar', 'baz', 1, 2, 3, 11, 12, 13]);

        $this->assertIsArray($array);
    }

    public function testDescendingKey()
    {
        $array = Arrays::descendingKey([1 => 'one', 2 => 'two', 'three' => 'three', 10 => 'ten']);

        $this->assertSame(['ten', 'two', 'one', 'three'], array_values($array));
    }

    public function testAscendingKey()
    {
        $array = Arrays::ascendingKey([1 => 'one', 2 => 'two', 'three' => 'three', 10 => 'ten']);

        $this->assertSame(['three', 'one', 'two', 'ten'], array_values($array));
    }

    public function testShuffle()
    {
        $array = Arrays::shuffle([1 => 'one', 2 => 'two', 'three' => 'three', 10 => 'ten']);

        $this->assertIsArray($array);
    }

    public function testNatural()
    {
        $array = Arrays::natural(['a', 'A', 'B', 'C', 'c', 'b']);

        $this->assertSame(['A', 'B', 'C', 'a', 'b', 'c'], array_values($array));
    }

    public function testNaturalInsensitive()
    {
        $array = Arrays::naturalInsensitive(['a', 'A', 'B', 'C', 'c', 'b']);

        $this->assertSame(['a', 'A', 'B', 'b', 'C', 'c'], array_values($array));
    }
}