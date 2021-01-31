<?php namespace ZN\Request;

use URI;

class URIDataTest extends \PHPUnit\Framework\TestCase
{
    public function testUriDataStringParameter()
    {
        $this->assertEquals('foo', URI::data('foo/bar/baz')::get(1));
        $this->assertEquals('baz', URI::data('/foo/bar/baz/')::get(3));
    }

    public function testUriDataArrayParameter()
    {
        $this->assertEquals('foo', URI::data(['foo', 'bar', 'baz'])::get(1));
    }

    public function testUriDataWithSegment()
    {
        $this->assertEquals('bar', URI::data('foo/bar/baz')::segment(2));
        $this->assertEquals('baz', URI::data('foo/bar/baz')::segment(-1));
    }

    public function testUriDataWithTotalSegments()
    {
        $this->assertEquals(3, URI::data('foo/bar/baz')::totalSegments());
    }

    public function testUriDataWithCall()
    {
        $this->assertEquals('foo', URI::data('foo/bar/baz')->s1());
        $this->assertEquals('baz', URI::data('foo/bar/baz')->e1());
        $this->assertEquals('baz', URI::data('foo/bar/baz')->bar());
    }
}