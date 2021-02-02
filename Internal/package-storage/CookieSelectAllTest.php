<?php namespace ZN\Storage;

use Cookie;

class CookieSelectAllTest extends StorageExtends
{
    public function testSelectAll()
    {
        $this->insert('example', 'Example');

        $this->assertIsArray(Cookie::selectAll());
    }
}