<?php namespace ZN\Cache;

use Cache;

class FileTest extends \PHPUnit\Framework\TestCase
{
    public function testView()
    {
        $content = Cache::file('zeroneed.php');

        $this->assertIsString($content);
    }
}