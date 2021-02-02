<?php namespace ZN\Storage;

use Session;

class SessionDeleteTest extends \PHPUnit\Framework\TestCase
{
    public function testDelete()
    {
        Session::example('Example');

        Session::delete('example');

        $this->assertEmpty(Session::example());
    }

    public function testDeleteCall()
    {
        Session::example('Example');

        Session::exampleDelete();

        $this->assertEmpty(Session::example());
    }
}