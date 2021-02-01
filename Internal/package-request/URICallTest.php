<?php namespace ZN\Request;

use URI;

class URICallTest extends \PHPUnit\Framework\TestCase
{
    public function testUriCallStart()
    {
        $_SERVER['REQUEST_URI'] = 'contact/us/sendForm/count/test';

        $this->assertEquals('contact', URI::s1());
        $this->assertEquals('us', URI::s2());
    }

    public function testUriCallEnd()
    {
        $_SERVER['REQUEST_URI'] = 'contact/us/sendForm/count/test';

        $this->assertEquals('test', URI::e1());
        $this->assertEquals('count', URI::e2());
    }

    public function testUriCallName()
    {
        $_SERVER['REQUEST_URI'] = 'contact/us/sendForm/count/test';

        $this->assertEquals('us', URI::contact());
    }

    public function testUriCallNameWithIndexParameter()
    {
        $_SERVER['REQUEST_URI'] = 'contact/us/sendForm/count/test';

        $this->assertEquals('sendForm', URI::contact(2));
    }
}