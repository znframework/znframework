<?php namespace ZN\Helpers;

use Mime;

class MimeTest extends \ZN\Test\GlobalExtends
{
    public function testCall()
    {
        $this->assertIsArray(Mime::avi());

        $this->assertSame('audio/x-acc', Mime::aac());
    }

    public function testIsCall()
    {
        $this->assertFalse(Mime::isImage(self::default . 'package-filesystem/resources/test.csv'));
        $this->assertTrue(Mime::isText(self::default . 'package-filesystem/resources/example.txt'));
    }

    public function testType()
    {
        $this->assertSame('text/plain', Mime::type(self::default . 'package-filesystem/resources/test.csv'));
    }
}