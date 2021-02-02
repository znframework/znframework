<?php namespace ZN\Cache;

use Cache;

class CleanTest extends \PHPUnit\Framework\TestCase
{
    public function testClean()
    {
        Cache::insert('a', 1);

        Cache::clean();

        $this->assertEmpty(Cache::select('a'));
    }
}