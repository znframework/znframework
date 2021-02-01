<?php namespace ZN\Request;

use URI;

class URISegmentArrayTest extends \PHPUnit\Framework\TestCase
{
    public function testUriSegmentArray()
    {
        $_SERVER['REQUEST_URI'] = 'contact/us/sendForm';

        $this->assertEquals(['contact', 'us', 'sendForm'], URI::segmentArray());
    }
}