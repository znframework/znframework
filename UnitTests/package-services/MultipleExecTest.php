<?php namespace ZN\Services;

use CURL;

class MultipleExecTest extends \PHPUnit\Framework\TestCase
{
    public function testExec()
    {
        $response = CURL::multiple()
             ->returntransfer(1)->init('https://github.com/')
             ->returntransfer(1)->init('https://google.com/')
             ->exec();

   
        $this->assertEquals(2, count($response));
    }
}