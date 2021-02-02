<?php namespace ZN\Storage;

use Session;

class SessionSelectAllTest extends \PHPUnit\Framework\TestCase
{
    public function testSelectAll()
    {
        Session::example('Example');

        $this->assertIsArray(Session::selectAll());
    }

    public function testSelectAllCall()
    {
        Session::example('Example');

        $this->assertIsArray(Session::all());
    }
}