<?php namespace ZN\Services;

use Post;
use Restful;

class PostTest extends \PHPUnit\Framework\TestCase
{
    public function testPost()
    {
        Restful::post('path/example', ['example' => 'Example']);

        $this->assertStringContainsString('path/example', Restful::info('all')['url']);
    }
}