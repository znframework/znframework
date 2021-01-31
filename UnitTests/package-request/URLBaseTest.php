<?php namespace ZN\Request;

use URL;

class URLBaseTest extends \PHPUnit\Framework\TestCase
{
    public function testUrlBase()
    {
        $this->assertStringContainsString(BASE_DIR, URL::base());
    }
    

    public function testUrlBaseFirstParameter()
    {
        $this->assertStringContainsString('/resources/style.css', URL::base('resources/style.css'));
    }
}