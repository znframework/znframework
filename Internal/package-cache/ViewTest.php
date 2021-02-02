<?php namespace ZN\Cache;

use Cache;

class ViewTest extends \PHPUnit\Framework\TestCase
{
    public function testView()
    {
        $content = Cache::view('Home/main');

        $this->assertIsString($content);
    }
}