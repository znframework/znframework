<?php namespace ZN\Storage;

use Cookie;

class CookieDecodeTest extends StorageExtends
{
    public function testDecode()
    {
        $this->insert('example', 'Example', 'sha1');

        $this->assertEquals('Example', Cookie::decode('sha1')->example());
    }
}