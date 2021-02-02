<?php namespace ZN\Storage;

use Session;

class SessionSelectTest extends \PHPUnit\Framework\TestCase
{
    public function testSelect()
    {
        Session::example('Example');

        $this->assertEquals('Example', Session::select('example'));
    }

    public function testSelectCall()
    {
        Session::example('Example');

        $this->assertEquals('Example', Session::example());
    }
}