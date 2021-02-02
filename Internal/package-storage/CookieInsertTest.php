<?php namespace ZN\Storage;

use Cookie;

class CookieInsertTest extends StorageExtends
{
    public function testInsert()
    {
        $this->insert('example', 'Example');

        $this->assertEquals('Example', Cookie::select('example'));
    }
}