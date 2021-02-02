<?php namespace ZN\Storage;

use Session;

class SessionDecodeTest extends \PHPUnit\Framework\TestCase
{
    public function testDecode()
    {
        Session::encode('md5')->example('Example');

        $this->assertEquals('Example', Session::decode('md5')->example());
    }
}