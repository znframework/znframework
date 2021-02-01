<?php namespace ZN\DataTypes\Arrays;

use Arrays;

class GetTest extends \PHPUnit\Framework\TestCase
{
    public function testGetFirst()
    {
        $array = Arrays::getFirst(['foo', 'bar'], 1);

        $this->assertSame('foo', $array);
    }

    public function testGetFirstSecondVariation()
    {
        $array = Arrays::getFirst(['foo', 'bar', 'baz'], 2);

        $this->assertSame(['foo', 'bar'], $array);
    }

    public function testGetFirstThirdVariation()
    {
        $array = Arrays::getFirst(['zoo' => 'foo', 'bar'], 1);

        $this->assertSame('foo', $array);
    }

    public function testGetFirstFourthVariation()
    {
        $array = Arrays::getFirst(['zoo' => 'foo', 'bar', 'baz'], 2);

        $this->assertSame(['zoo' => 'foo', 'bar'], $array);
    }

    public function testGetLast()
    {
        $array = Arrays::getLast(['foo', 'bar'], 1);

        $this->assertSame('bar', $array);
    }

    public function testGetLastSecondVariation()
    {
        $array = Arrays::getLast(['foo', 'bar', 'baz'], 2);

        $this->assertSame(['bar', 'baz'], $array);
    }

    public function testGetLastThirdVariation()
    {
        $array = Arrays::getLast(['foo', 'zoo' => 'bar'], 1);

        $this->assertSame('bar', $array);
    }

    public function testGetLastFourthVariation()
    {
        $array = Arrays::getLast(['foo', 'bar', 'zoo' => 'baz'], 2);

        $this->assertSame(['bar', 'zoo' => 'baz'], $array);
    }
}