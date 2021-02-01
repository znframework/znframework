<?php namespace ZN\Services;

use Restful;

class DeleteTest extends \PHPUnit\Framework\TestCase
{
    public function testDelete()
    {
        Restful::delete('path/example', ['example' => 'Example']);

        $this->assertStringContainsString('path/example', Restful::info('all')['url']);
    }
}