<?php namespace ZN\Services;

use CDN;

class LinkTest extends \PHPUnit\Framework\TestCase
{
    public function testLink()
    {
        $this->assertStringContainsString('keyframes.min.js', CDN::link('jquerykeyframes'));
    }

    public function testLinks()
    {
        $this->assertStringContainsString('keyframes.min.js', CDN::links()['jquerykeyframes']);
    }
}