<?php namespace ZN\Request;

use URI;

class URIGetNameCountTest extends \PHPUnit\Framework\TestCase
{
    public function testUriGetNameCount()
    {
        $_SERVER['REQUEST_URI'] = 'contact/us/sendForm/count/test';

        $this->assertEquals(4, URI::getNameCount('contact'));
    }
}