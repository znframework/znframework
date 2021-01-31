<?php namespace ZN\Request;

use URI;

class URIPrevTest extends \PHPUnit\Framework\TestCase
{
    public function testUriPrev()
    {
        $_SERVER['HTTP_REFERER'] = 'contact/us/sendForm';

        $this->assertEquals('contact/us/sendForm', URI::prev());
    }
}