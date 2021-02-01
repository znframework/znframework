<?php namespace ZN\Services;

use CDN;

class StyleTest extends \PHPUnit\Framework\TestCase
{
    public function testStyle()
    {
        $this->assertStringContainsString('bootstrap.min.css', CDN::style('bootstrap'));
    }
}