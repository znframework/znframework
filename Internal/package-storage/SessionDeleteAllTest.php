<?php namespace ZN\Storage;

use Session;

class SessionDeleteAllTest extends \PHPUnit\Framework\TestCase
{
    public function testDeleteAll()
    {
        Session::example('Example');

        Session::deleteAll();

        $this->assertEmpty(Session::example());
    }
}
