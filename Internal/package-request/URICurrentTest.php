<?php namespace ZN\Request;

use URI;

class URICurrentTest extends \PHPUnit\Framework\TestCase
{
    public function testUriCurrent()
    {
        $_SERVER['PATH_INFO'] = 'contact/us/sendForm';

        $this->assertEquals('contact/us/sendForm', URI::current());
    }
}