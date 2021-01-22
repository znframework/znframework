<?php namespace ZN\Buffering;

class InsertTest extends \PHPUnit\Framework\TestCase
{
    public function testDo()
    {
        $insert = new Insert;

        $this->assertTrue($insert->do('a', 1));
    }
}