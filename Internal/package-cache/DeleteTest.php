<?php namespace ZN\Cache;

use Cache;

class DeleteTest extends \PHPUnit\Framework\TestCase
{
    public function testDelete()
    {
        Cache::insert('exapmle', 1);

        Cache::delete('example');

        $this->assertEmpty(Cache::select('example'));
    }
}