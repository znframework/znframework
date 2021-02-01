<?php namespace ZN\DataTypes\Strings;

use Strings;

class FixTest extends \PHPUnit\Framework\TestCase
{
    public function testAddPrefix()
    {
        $this->assertSame('+++foo', Strings::addPrefix('foo', '+++'));
    }

    public function testAddPrefixNoRepeat()
    {
        $this->assertSame('+++foo', Strings::addPrefix('+++foo', '+++'));
    }

    public function testRemovePrefix()
    {
        $this->assertSame('foo', Strings::removePrefix('+++foo', '+++'));
    }

    public function testAddSuffix()
    {
        $this->assertSame('foo+++', Strings::addSuffix('foo', '+++'));
    }

    public function testAddSuffixNoRepeat()
    {
        $this->assertSame('foo+++', Strings::addSuffix('foo+++', '+++'));
    }

    public function testRemoveSuffix()
    {
        $this->assertSame('foo', Strings::removeSuffix('foo+++', '+++'));
    }

    public function testAddBothFix()
    {
        $this->assertSame('+++foo+++', Strings::addBothFix('foo', '+++'));
    }

    public function testAddBothFixNoRepeat()
    {
        $this->assertSame('+++foo+++', Strings::addBothFix('foo+++', '+++'));
    }

    public function testRemoveBothFix()
    {
        $this->assertSame('foo', Strings::removeBothFix('+++foo+++', '+++'));
    }
}