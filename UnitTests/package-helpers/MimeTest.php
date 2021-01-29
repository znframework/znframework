<?php namespace ZN\Helpers;

use Mime;

class MimeTest extends \PHPUnit\Framework\TestCase
{
    public function testCall()
    {
        $this->assertIsArray(Mime::avi());

        $this->assertSame('audio/x-acc', Mime::aac());
    }

    public function testIsCall()
    {
        $this->assertFalse(Mime::isImage('UnitTests/package-filesystem/resources/test.csv'));
        $this->assertTrue(Mime::isText('UnitTests/package-filesystem/resources/example.txt'));
    }

    public function testType()
    {
        $this->assertSame('text/plain', Mime::type('UnitTests/package-filesystem/resources/test.csv'));
    }
}