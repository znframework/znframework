<?php namespace ZN\Services;

use Restful;

class GetTest extends \PHPUnit\Framework\TestCase
{
    public function testGet()
    {
        $this->assertIsObject(Restful::get('https://repo.packagist.org/p/znframework/znframework.json'));
    }
}