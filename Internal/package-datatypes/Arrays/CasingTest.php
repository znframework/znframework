<?php namespace ZN\DataTypes\Arrays;

use Arrays;

class CasingTest extends \PHPUnit\Framework\TestCase
{
    public function testCasingUpper()
    {
        $array = Arrays::casing(['foo', 'bar', 'zoo' => 'zoo'], 'upper');

        $this->assertSame(['FOO', 'BAR', 'ZOO' => 'ZOO'], $array);
    }

    public function testCasingLower()
    {
        $array = Arrays::casing(['foo', 'bar', 'zoo' => 'zoo'], 'lower');

        $this->assertSame(['foo', 'bar', 'zoo' => 'zoo'], $array);
    }

    public function testCasingTitle()
    {
        $array = Arrays::casing(['foo', 'bar', 'zoo' => 'zoo'], 'title');

        $this->assertSame(['Foo', 'Bar', 'Zoo' => 'Zoo'], $array);
    }

    public function testCasingUpperOnlyKeys()
    {
        $array = Arrays::casing(['foo', 'bar', 'zoo' => 'zoo'], 'upper', 'key');

        $this->assertSame(['foo', 'bar', 'ZOO' => 'zoo'], $array);
    }

    public function testCasingUpperOnlyValues()
    {
        $array = Arrays::casing(['foo', 'bar', 'zoo' => 'zoo'], 'upper', 'value');

        $this->assertSame(['FOO', 'BAR', 'zoo' => 'ZOO'], $array);
    }

    public function testLowerKeys()
    {
        $array = Arrays::lowerKeys(['foo', 'bar', 'ZOO' => 'zoo']);

        $this->assertSame(['foo', 'bar', 'zoo' => 'zoo'], $array);
    }

    public function testTitleKeys()
    {
        $array = Arrays::titleKeys(['foo', 'bar', 'zoo' => 'zoo']);

        $this->assertSame(['foo', 'bar', 'Zoo' => 'zoo'], $array);
    }

    public function testUpperKeys()
    {
        $array = Arrays::upperKeys(['foo', 'bar', 'zoo' => 'zoo']);

        $this->assertSame(['foo', 'bar', 'ZOO' => 'zoo'], $array);
    }

    public function testLowerValues()
    {
        $array = Arrays::lowerValues(['foo', 'bar', 'zoo' => 'ZOO']);

        $this->assertSame(['foo', 'bar', 'zoo' => 'zoo'], $array);
    }

    public function testTitleValues()
    {
        $array = Arrays::titleValues(['foo', 'bar', 'zoo' => 'zoo']);

        $this->assertSame(['Foo', 'Bar', 'zoo' => 'Zoo'], $array);
    }

    public function testUpperValues()
    {
        $array = Arrays::upperValues(['foo', 'bar', 'zoo' => 'zoo']);

        $this->assertSame(['FOO', 'BAR', 'zoo' => 'ZOO'], $array);
    }
}