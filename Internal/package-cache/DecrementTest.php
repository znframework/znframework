<?php namespace ZN\Cache;

use Cache;

class DecrementTest extends \PHPUnit\Framework\TestCase
{
    public function testIncrement()
    {
        Cache::insert('a', 2);

        Cache::decrement('a');

        $this->assertEquals(1, Cache::select('a'));
    }
}