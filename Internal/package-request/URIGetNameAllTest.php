<?php namespace ZN\Request;

use URI;

class URIGetNameAllTest extends \PHPUnit\Framework\TestCase
{
    public function testUriGetNameAll()
    {
        $_SERVER['REQUEST_URI'] = 'contact/us/sendForm/count/test';

        $this->assertEquals('sendForm/count/test', URI::getNameAll('us'));
    }
}