<?php namespace ZN\Security;

use Security;

class ScriptTagTest extends \PHPUnit\Framework\TestCase
{
    public function testScriptTagEncode()
    {
        $this->assertEquals('&#60;script&#62;alert(1);&#60;/script&#62;', Security::scriptTagEncode('<script>alert(1);</script>'));
    }

    public function testScriptTagDecode()
    {
        $this->assertEquals('<script>alert(1);</script>', Security::scriptTagDecode('&#60;script&#62;alert(1);&#60;/script&#62;'));
    }
}