<?php namespace ZN\Services;

use Post;
use Restful;

class GetRawDataTest extends \PHPUnit\Framework\TestCase
{
    public function testGetRawData()
    {
        $this->assertEmpty(Restful::getRawData());
    }

    public function testGetRawDataArray()
    {
        $this->assertEmpty(Restful::getRawDataArray());
    }

    public function testGetRawDataObject()
    {
        $this->assertNull(Restful::getRawDataObject());
    }
}