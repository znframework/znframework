<?php namespace ZN\Helpers;

use Iterate;

class IteratorTest extends \PHPUnit\Framework\TestCase
{
    public function testArray()
    {
        $iterator = Iterate::array(['a', 'b', 'c']);

        $iterator->next();
        $iterator->next();

        $this->assertSame('c', $iterator->current());
    }
}