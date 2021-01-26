<?php namespace ZN\DataTypes\Strings;

use Strings;

class SearchTest extends \PHPUnit\Framework\TestCase
{
    public function testSearch()
    {
        $this->assertSame('bar zoo', Strings::search('foo bar zoo', 'bar'));
        $this->assertSame(4, Strings::search('foo bar zoo', 'bar', 'position'));
        $this->assertSame(false, Strings::search('foo bar zoo', 'Bar'), true);
        $this->assertSame('Bar zoo', Strings::search('foo Bar zoo', 'Bar'), true);
    }

    public function testSearchPosition()
    {
        $this->assertSame(4, Strings::searchPosition('foo bar zoo', 'bar'));
    }

    public function testSearchString()
    {
        $this->assertSame('bar zoo', Strings::searchString('foo bar zoo', 'bar'));
    }

    public function testSearchBetween()
    {
        $this->assertSame(' bar ', Strings::searchBetween('foo bar zoo', 'foo', 'zoo'));
    }

    public function testSearchBetweenBoth()
    {
        $this->assertSame('oo bar zo', Strings::searchBetweenBoth('foo bar zoo', 'oo', 'zo'));
    }
}