<?php namespace ZN\Helpers;

use Cleaner;

class CleanerTest extends \PHPUnit\Framework\TestCase
{
    public function testData()
    {
        $this->assertSame('@znframework.com', Cleaner::data('robot@znframework.com', 'robot'));
        $this->assertSame('@znframework', Cleaner::data('robot@znframework.com', ['robot', '.com']));
        $this->assertSame([0 => 'a', 2 => 'c'], Cleaner::data(['a', 'b', 'c'], 'b'));
        $this->assertSame([0 => 'a'], Cleaner::data(['a', 'b', 'c'], ['b', 'c']));
    }
}