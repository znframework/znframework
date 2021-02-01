<?php namespace ZN\Services;

use Restful;

class PostTest extends \PHPUnit\Framework\TestCase
{
    public function testPost()
    {
        Restful::post('path/example', ['example' => 'Example']);

        $this->assertStringContainsString('path/example', Restful::info('all')['url']);
    }

    public function testPostJson()
    {
        Restful::postJson('path/example', ['example' => 'Example']);

        $this->assertStringContainsString('path/example', Restful::info('all')['url']);
    }
}