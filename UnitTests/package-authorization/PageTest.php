<?php namespace ZN\Authorization;

use ZN\Config;

class PageTest extends \PHPUnit\Framework\TestCase
{
    public function testUse()
    {
        $class = new Page;

        $this->assertFalse($class->use(1));

        Config::set('Auth', 'page', 
        [
            '1' => 'all',
            '2' => ['noperm' => ['delete']],
            '3' => ['noperm' => ['add', 'update', 'delete']]
        ]);

        $this->assertTrue($class->use(1));
    }
}