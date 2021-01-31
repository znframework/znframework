<?php namespace ZN\Request;

use Redirect;

class RefreshTest extends \PHPUnit\Framework\TestCase
{
    public function testLocation()
    {
        Redirect::refresh('profile', 2);
    }
}