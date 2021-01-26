<?php namespace ZN\DataTypes;

use Collection;

class CollectionTest extends \PHPUnit\Framework\TestCase
{
    public function testString()
    {
        $data  = ['foo', 'bar', 'baz'];
        $data2 = ['zoo', 'coo'];

        $collection = Collection::data($data)
                                ->merge($data2)
                                ->reverse()
                                ->removeLast()
                                ->addFirst(['xoo', 'yoo'])
                                ->get();

        $this->assertSame(['xoo', 'yoo', 'zoo', 'foo', 'coo', 'baz'], $collection);
    }
}