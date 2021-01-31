<?php namespace ZN\Request;

use Get;

class GetTest extends \PHPUnit\Framework\TestCase
{
    public function testGet()
    {
        Get::example('Example');

        $this->assertEquals('Example', Get::example());
    }

    public function testGetAll()
    {
        Get::example('Example');

        $this->assertContains('Example', Get::all());
    }
}