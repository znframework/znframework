<?php namespace ZN\Security;

use Security;

class XSSTest extends \PHPUnit\Framework\TestCase
{
    public function testXSS()
    {
        $this->assertEquals('&#60;script&#62;alert(1);script&#62;', Security::xssEncode('<script>alert(1);script>'));
    }
}