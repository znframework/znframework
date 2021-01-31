<?php namespace ZN\Request;

use Server;

class ServerTest extends \PHPUnit\Framework\TestCase
{
    public function testServer()
    {
        $this->assertEquals($_SERVER['SCRIPT_NAME'], Server::scriptName());
    }

    public function testServerAll()
    {
        $this->assertIsArray(Server::all());
    }
}