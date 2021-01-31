<?php namespace ZN\Request;

use URI;

class URITotalSegmentsTest extends \PHPUnit\Framework\TestCase
{
    public function testUriTotalSegments()
    {
        $_SERVER['REQUEST_URI'] = 'contact/us/sendForm';

        $this->assertEquals(3, URI::totalSegments());
    }
}