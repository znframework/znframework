<?php namespace ZN\Cache;

use Cache;

class IncrementTest extends \PHPUnit\Framework\TestCase
{
    public function testIncrement()
    {
        Cache::insert('a', 1);

        Cache::increment('a');

        $this->assertEquals(2, Cache::select('a'));
    }
}