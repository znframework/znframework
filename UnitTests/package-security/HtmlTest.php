<?php namespace ZN\Security;

use Security;

class HtmlTest extends \PHPUnit\Framework\TestCase
{
    public function testHtmlEncode()
    {
        $this->assertEquals('&lt;b&gt;ZN4&lt;/b&gt;', Security::htmlEncode('<b>ZN4</b>'));
    }

    public function testHtmlDecode()
    {
        $this->assertEquals('<b>ZN4</b>', Security::htmlDecode('&lt;b&gt;ZN4&lt;/b&gt;'));
    }
}