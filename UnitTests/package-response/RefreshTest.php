<?php namespace ZN\Response;

use Redirect;

class RefreshTest extends \PHPUnit\Framework\TestCase
{
    public function testLocation()
    {
        Redirect::refresh('profile', 2);
    }
}