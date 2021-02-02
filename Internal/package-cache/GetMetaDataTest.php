<?php namespace ZN\Cache;

use Cache;

class GetMetaDataTest extends \PHPUnit\Framework\TestCase
{
    public function testGetMetaData()
    {
        Cache::insert('a', 1);

        $this->assertIsArray(Cache::getMetaData('a'));
    }
}