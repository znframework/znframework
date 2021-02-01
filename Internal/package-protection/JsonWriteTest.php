<?php namespace ZN\Protection;

use Json;

class JsonWriteTest extends Test\CommonExtends
{
    public function testWrite()
    {
        Json::write(self::dir . 'example', ['foo' => 'Foo', 'bar' => 'Bar']);

        $this->assertFileExists(self::dir . 'example.json');
    }
}