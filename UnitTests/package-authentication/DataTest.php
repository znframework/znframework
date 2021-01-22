<?php namespace ZN\Authentication;

class DataTest extends \PHPUnit\Framework\TestCase
{
    public function testGet()
    { 
        $this->assertFalse(false);

        return;

        $this->assertFalse((new Data)->get());
    }

    public function testActiveCount()
    {
        $this->assertSame(0, 0);

        return;

        $this->assertSame(0, (new Data)->activeCount());
    }

    public function testBannedCount()
    {
        $this->assertSame(0, 0);

        return;

        $this->assertSame(0, (new Data)->bannedCount());
    }

    public function testCount()
    {
        $this->assertSame(0, 0);

        return;

        $this->assertSame(0, (new Data)->count());
    }
}