<?php namespace ZN\Storage;

use Session;

class SessionInsertTest extends \PHPUnit\Framework\TestCase
{
    public function testInsert()
    {
        $this->assertTrue(Session::insert('example', 'Example'));
    }

    public function testInsertCall()
    {
        $this->assertTrue(Session::example('Example'));
    }
}