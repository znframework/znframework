<?php namespace ZN\Cache;

use Cache;

class InsertTest extends \PHPUnit\Framework\TestCase
{
    public function testInsert()
    {
        Cache::insert('example', 1);

        $this->assertEquals(1, Cache::select('example'));
    }
}