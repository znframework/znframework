<?php namespace ZN\Buffering;

class SelectTest extends \PHPUnit\Framework\TestCase
{
    public function testDo()
    {
        $select = new Select;
        $insert = new Insert;

        $insert->do('a', 1);
        
        $this->assertSame(1, $select->do('a'));
    }
}