<?php namespace ZN\Language;

use Lang;
use Config;

class LangTest extends \PHPUnit\Framework\TestCase
{
    public function testSet()
    {
        Lang::set('tr');

        $this->assertSame('tr', Lang::get());
    }

    public function testGet()
    {
        Lang::set('en');

        $this->assertSame('en', Lang::get());
    }

    public function testCurrent()
    {
        $this->assertSame(false, Lang::current());

        Config::services('uri', ['lang' => true]);

        $this->assertSame('en', Lang::current());

        Config::services('uri', ['lang' => false]);
    }

    public function testSelect()
    {
        $this->assertSame('Operation failed!', Lang::select('Error', 'error'));
        $this->assertSame('`TEST` Invalid Command!', Lang::select('Commands', 'invalidCommand', ['%' => 'TEST']));
    }
}