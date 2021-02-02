<?php namespace ZN\Cache;

use Cache;

class InfoTest extends \PHPUnit\Framework\TestCase
{
    public function testInfo()
    {
        Cache::insert('a', 1);

        $this->assertEquals('a', Cache::info('a')['basename']);
    }
}