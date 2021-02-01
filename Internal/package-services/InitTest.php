<?php namespace ZN\Services;

use CURL;

class InitTest extends \PHPUnit\Framework\TestCase
{
    public function testInit()
    {
        CURL::init('https://github.com/')->returntransfer(true)->exec();

        $this->assertEquals('https://github.com/', CURL::info()['url']);
    }
}