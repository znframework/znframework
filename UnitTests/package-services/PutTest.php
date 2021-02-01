<?php namespace ZN\Services;

use Restful;

class PutTest extends \PHPUnit\Framework\TestCase
{
    public function testPut()
    {
        Restful::put('path/example', ['example' => 'Example']);

        $this->assertStringContainsString('path/example', Restful::info('all')['url']);
    }

    public function testPutJson()
    {
        Restful::putJson('path/example', ['example' => 'Example']);

        $this->assertStringContainsString('path/example', Restful::info('all')['url']);
    }
}