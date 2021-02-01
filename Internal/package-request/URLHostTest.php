<?php namespace ZN\Request;

use URL;

class URLHostTest extends \PHPUnit\Framework\TestCase
{
    public function testUrlHost()
    {
        # Does not include BASE_DIR
        $this->assertStringEndsWith('/', URL::host());
    }
    

    public function testUrlHostFirstParameter()
    {
        $this->assertStringContainsString('/about/me', URL::host('about/me'));
    }
}