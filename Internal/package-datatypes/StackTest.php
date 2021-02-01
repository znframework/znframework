<?php namespace ZN\DataTypes;

use Stack;

class StackTest extends \PHPUnit\Framework\TestCase
{
    public function testString()
    {
        $data = Stack::data('bar foo baz')
                     ->upperCase()
                     ->replace('BAZ', 'COO')
                     ->get();

        $this->assertSame('BAR FOO COO', $data);
    }
}