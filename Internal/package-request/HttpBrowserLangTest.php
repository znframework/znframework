<?php namespace ZN\Request;

use Http;

class HttpBrowserLangTest extends \PHPUnit\Framework\TestCase
{
    public function testBrowserLang()
    {
        $this->assertEquals('en', Http::browserLang());
    }
}