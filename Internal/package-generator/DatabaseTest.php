<?php namespace ZN\Generator;

use Generate;

class DatabaseTest extends GeneratorExtends
{
    public function testDatabase()
    {
        $this->assertNull(Generate::databases());
    }
}