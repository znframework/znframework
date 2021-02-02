<?php namespace ZN\Storage;

use Cookie;

class CookieEncodeTest extends StorageExtends
{
    public function testEncode()
    {
        $this->insert('example', 'Example', 'sha1');

        $this->assertEquals('Example', Cookie::decode('sha1')->example());
    }
}