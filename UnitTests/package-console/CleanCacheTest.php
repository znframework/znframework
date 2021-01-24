<?php namespace ZN\Console;

use Cache;

class CleanCacheTest extends \PHPUnit\Framework\TestCase
{
    public function testCleanCache()
    {
        Cache::insert('a', 'value');

        new CleanCache;

        if( $value = Cache::select('a') )
        {
            $this->assertTrue('value', $value);
        }
        else
        {
            $this->assertEmpty($value);
        }
    }
}