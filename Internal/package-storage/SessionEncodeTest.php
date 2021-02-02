<?php namespace ZN\Storage;

use Session;

class SessionEncodeTest extends \PHPUnit\Framework\TestCase
{
    public function testEncode()
    {
        Session::encode('md5')->example('Example');

        $this->assertEquals('Example', Session::decode('md5')->example());
    }
}