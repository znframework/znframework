<?php namespace ZN\Request;

use URI;

class URIBaseTest extends \PHPUnit\Framework\TestCase
{
    public function testUriBase()
    {
        $this->assertStringEndsWith('/', URI::base());
    }
}