<?php namespace ZN\DataTypes\Arrays;

use Arrays;

class PickTest extends \PHPUnit\Framework\TestCase
{
    public function testPick()
    {
        $arr = 
        [
            ['name' => 'ZN'],
            ['name' => 'Framework']
        ];

        $return = Arrays::pick($arr, 'name');

        $this->assertSame(['ZN', 'Framework'], $return);
    }
}