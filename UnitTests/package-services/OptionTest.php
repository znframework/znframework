<?php namespace ZN\Services;

use CURL;

class OptionTest extends \PHPUnit\Framework\TestCase
{
    public function testOption()
    {
        CURL::init('https://github.com/')
            ->option('returntransfer', true)
            ->option('header', false)
            ->exec();

        $this->assertEquals('https://github.com/', CURL::info()['url']);
    }

    public function testOptionCall()
    {
        CURL::init('https://github.com/')
            ->returntransfer(true)
            ->header(false)
            ->exec();

        $this->assertEquals('https://github.com/', CURL::info()['url']);
    }
}