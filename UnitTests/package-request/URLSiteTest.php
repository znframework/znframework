<?php namespace ZN\Request;

use URL;

class URLSiteTest extends \PHPUnit\Framework\TestCase
{
    public function testUrlSite()
    {
        $this->assertStringContainsString(BASE_DIR, URL::site());
    }
    

    public function testUrlSiteFirstParameter()
    {
        $this->assertStringContainsString('/Home/test', URL::site('Home/test'));
    }
}