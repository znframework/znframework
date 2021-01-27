<?php namespace ZN\DateTime;

use DT;

class DTTest extends \PHPUnit\Framework\TestCase
{
    public function testFirst()
    {
        $this->assertSame('2018-03-06', DT::date('2018/01/01')->addDay(5)->addMonth(2)->get());
    }
}