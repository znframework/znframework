<?php namespace ZN\Services;

use Restful;

class PatchTest extends \PHPUnit\Framework\TestCase
{
    public function testPatch()
    {
        Restful::patch('path/example', ['example' => 'Example']);

        $this->assertStringContainsString('path/example', Restful::info('all')['url']);
    }

    public function testPatchJson()
    {
        Restful::patchJson('path/example', ['example' => 'Example']);

        $this->assertStringContainsString('path/example', Restful::info('all')['url']);
    }
}