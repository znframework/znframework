<?php namespace ZN\Security;

use Security;

class ForeignCharTest extends \PHPUnit\Framework\TestCase
{
    public function testForeignCharEncode()
    {
        $this->assertEquals('&#192;&#341;&#231;', Security::foreignCharEncode('Àŕç'));
    }

    public function testForeignCharDecode()
    {
        $this->assertEquals('Àŕç', Security::foreignCharDecode('&#192;&#341;&#231;'));
    }
}