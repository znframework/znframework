<?php namespace ZN\Request;

use URL;
use Lang;
use Config;

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

    public function testUrlSiteLangFix()
    {
        Config::services('uri', ['lang' => true]); Lang::set('en');

        $this->assertStringContainsString('/en/resources/style.css', URL::site('resources/style.css'));

        Config::services('uri', ['lang' => false]);
    }
}