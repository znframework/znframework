<?php namespace ZN\Console;

use Cache;

class CleanCacheTest extends \PHPUnit\Framework\TestCase
{
    public function testCleanCache()
    {
        Cache::insert('a', 'value');

        new CleanCache;

        $this->assertEmpty(Cache::select('a'));
    }
}