<?php namespace ZN\Storage;

use Cookie;

class CookieDeleteAllTest extends StorageExtends
{
    public function testDeleteAll()
    {
        $this->insert('example', 'Example');

        Cookie::deleteAll();

        $this->assertEmpty(Cookie::select('example'));
    }
}