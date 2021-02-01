<?php namespace ZN\Buffering;

class DeleteTest extends \PHPUnit\Framework\TestCase
{
    public function testDo()
    {
        $delete = new Delete;
        $insert = new Insert;

        $this->assertTrue($delete->do(['a', 'b']));
        $this->assertFalse($delete->do('a'));

        $insert->do('a', 1);

        $this->assertTrue($delete->do('a'));
    }
}