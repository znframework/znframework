<?php namespace ZN\Request;

use URL;

class URLCurrentTest extends \PHPUnit\Framework\TestCase
{
    public function testUrlCurrent()
    {
        # Does not include BASE_DIR
        $this->assertStringEndsWith('/', URL::current());
    }
    

    public function testUrlSiteFirstParameter()
    {
        $this->assertStringContainsString('/about/me', URL::current('about/me'));
    }
}