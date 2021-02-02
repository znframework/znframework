<?php namespace ZN\Cache;

use Cache;

class SelectTest extends \PHPUnit\Framework\TestCase
{
    public function testSelect()
    {
        Cache::insert('example', 1);

        $this->assertEquals(1, Cache::select('example'));
    }
}