<?php namespace ZN\Request;

use URI;

class URICurrentSegmentTest extends \PHPUnit\Framework\TestCase
{
    public function testUriCurrentSegment()
    {
        $_SERVER['PATH_INFO']   = 'contact/us/sendForm';
        $_SERVER['REQUEST_URI'] = 'contact/us/sendForm';

        $this->assertEquals('sendForm', URI::currentSegment());
    }
}