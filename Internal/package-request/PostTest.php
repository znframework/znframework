<?php namespace ZN\Request;

use Post;

class PostTest extends \PHPUnit\Framework\TestCase
{
    public function testPost()
    {
        Post::example('Example');

        $this->assertEquals('Example', Post::example());
    }

    public function testPostAll()
    {
        Post::example('Example');

        $this->assertContains('Example', Post::all());
    }
}