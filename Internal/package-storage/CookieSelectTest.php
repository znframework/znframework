<?php namespace ZN\Storage;

use Cookie;

class CookieSelectTest extends StorageExtends
{
    public function testSelect()
    {
        $this->insert('example', 'Example');

        $this->assertEquals('Example', Cookie::select('example'));
    }
}