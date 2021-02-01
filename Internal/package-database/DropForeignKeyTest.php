<?php namespace ZN\Database;

use DBForge;

class DropForeignKeyTest extends DatabaseExtends
{
    public function testDropForeignKey()
    {
        DBForge::dropForeignKey('persons', 'perdepFK');

        $this->assertSame("ALTER TABLE persons DROP  CONSTRAINT perdepFK;", trim(DBForge::stringQuery()));
    }
}