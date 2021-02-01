<?php namespace ZN\Request;

use URL;

class URLPrevTest extends \PHPUnit\Framework\TestCase
{
    public function testUrlPrev()
    {
        $_SERVER['HTTP_REFERER'] = 'http://www.example.com/';

        $this->assertEquals('http://www.example.com/', URL::prev());
    }
}