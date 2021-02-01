<?php namespace ZN\Services;

use CURL;

class ExecTest extends \PHPUnit\Framework\TestCase
{
    public function testExec()
    {
        CURL::init('https://github.com/')
            ->option('returntransfer', true)
            ->option('header', false)
            ->exec();

        $this->assertEquals('https://github.com/', CURL::info()['url']);
    }
}