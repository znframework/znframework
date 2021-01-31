<?php namespace ZN\Request;

use URI;

class URIGetTest extends \PHPUnit\Framework\TestCase
{
    public function testUriGet()
    {
        $_SERVER['REQUEST_URI'] = 'contact/us/sendForm/';

        $this->assertEquals('us', URI::get('contact'));
    }

    public function testUriGetWithIndexParameter()
    {
        $this->assertEquals('sendForm', URI::get('contact', 2));
    }

    public function testUriGetWithIndexParameterSetCount()
    {
        $this->assertEquals(2, URI::get('contact', 'count'));
    }

    public function testUriGetWithIndexParameterSetAll()
    {
        $this->assertEquals('us/sendForm', URI::get('contact', 'all'));
    }

    public function testUriGetWithWhileParameter()
    {
        $this->assertEquals('contact/us/sendForm', URI::get('contact', 'sendForm', true));
    }

    public function testUriGetSetIndexAndWhileParameters()
    {
        $this->assertEquals('us/sendForm', URI::get('contact', 2, true));
    }

    public function testUriGetSetNumericIndexParameter()
    {
        $this->assertEquals('contact', URI::get(1));
        $this->assertEquals('us', URI::get(2));
    }

    public function testUriGetSetNumericGetAndIndexParameters()
    {
        $this->assertEquals('contact/us', URI::get(1, 2));
    }

    public function testUriGetSetNegativeNumericGetAndIndexParameters()
    {
        $this->assertEquals('us/sendForm', URI::get(2, -1));
        $this->assertEquals('contact/us', URI::get(1, -2));
    }
}