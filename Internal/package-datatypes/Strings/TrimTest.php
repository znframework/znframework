<?php namespace ZN\DataTypes\Strings;

use Strings;

class TrimTest extends \PHPUnit\Framework\TestCase
{
    public function testMtrim()
    {
        $this->assertSame('foobarbaz', Strings::mtrim(' foo bar    baz'));
    }

    public function testTrimSlashes()
    {
        $this->assertSame('foo', Strings::trimSlashes('/foo/'));
    }
}