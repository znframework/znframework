<?php namespace ZN\Buffering;

class FileTest extends \PHPUnit\Framework\TestCase
{
    public function testDo()
    {
        $file = new File;

        $this->assertIsString($file->do('robots.txt'));
    }
}