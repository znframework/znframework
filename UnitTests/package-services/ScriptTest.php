<?php namespace ZN\Services;

use CDN;

class ScriptTest extends \PHPUnit\Framework\TestCase
{
    public function testScript()
    {
        $this->assertStringContainsString('bootstrap.min.js', CDN::script('bootstrap'));
    }
}