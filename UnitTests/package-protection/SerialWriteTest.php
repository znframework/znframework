<?php namespace ZN\Protection;

use Serial;

class SerialWriteTest extends Test\CommonExtends
{
    public function testWrite()
    {
        Serial::write(self::dir . 'serial', ['foo' => 'Foo', 'bar' => 'Bar']);

        $this->assertFileExists(self::dir . 'serial');
    }
}