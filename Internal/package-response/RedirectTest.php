<?php namespace ZN\Response;

use Redirect;

class RedirectTest extends \PHPUnit\Framework\TestCase
{
    public function testLocation()
    {
        Redirect::location('profile', 0, ['example' => 'Data'], false);
    }

    public function testSelect()
    {
        $this->assertEquals('Data', Redirect::select('example'));
    }
}