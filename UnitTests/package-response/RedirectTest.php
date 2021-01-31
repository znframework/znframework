<?php namespace ZN\Request;

use Redirect;

class RedirectTest extends \PHPUnit\Framework\TestCase
{
    public function testLocation()
    {
        Redirect::location('profile', 0, [], false);
    }
}