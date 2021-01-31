<?php namespace ZN\Request;

use URL;

class URLBaseTest extends \PHPUnit\Framework\TestCase
{
    public function testUrlSite()
    {
        $this->assertStringContainsString(BASE_DIR, URL::base());
    }
    

    public function testUrlSiteFirstParameter()
    {
        $this->assertStringContainsString('/resources/style.css', URL::base('resources/style.css'));
    }
}