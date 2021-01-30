<?php namespace ZN\Generator;

use Generate;

class DatabaseTest extends Test\GeneratorExtends
{
    public function testDatabase()
    {
        $this->assertNull(Generate::databases());
    }
}