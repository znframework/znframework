<?php namespace ZN\Request;

use URI;

class URIGetByNameTest extends \PHPUnit\Framework\TestCase
{
    public function testUriGetByName()
    {
        $_SERVER['REQUEST_URI'] = 'contact/us/sendForm/count/test';

        $this->assertEquals('us', URI::getByName('contact'));
        $this->assertEquals('count', URI::getByName('sendForm'));
    }

    public function testUriGetByNameWithIndexParameter()
    {
        $_SERVER['REQUEST_URI'] = 'contact/us/sendForm/count/test';

        $this->assertEquals('sendForm/count/test', URI::getByName('sendForm', 'test'));
    }
}