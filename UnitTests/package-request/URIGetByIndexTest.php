<?php namespace ZN\Request;

use URI;

class URIGetByIndexTest extends \PHPUnit\Framework\TestCase
{
    public function testUriGetByIndex()
    {
        $_SERVER['REQUEST_URI'] = 'contact/us/sendForm/count/test';

        $this->assertEquals('contact', URI::getByIndex(1));
    }

    public function testUriGetByIndexWithIndexParameter()
    {
        $_SERVER['REQUEST_URI'] = 'contact/us/sendForm/count/test';

        $this->assertEquals('contact/us', URI::getByIndex(1, 2));
    }

    public function testUriGetByIndexWithNegativeIndexParameter()
    {
        $_SERVER['REQUEST_URI'] = 'contact/us/sendForm/count/test';

        $this->assertEquals('us/sendForm', URI::getByIndex(2, -3));
    }
}