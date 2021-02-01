<?php namespace ZN\Database;

use DBForge;

class DropPrimaryKeyTest extends DatabaseExtends
{
    public function testDropPrimaryKey()
    {
        DBForge::dropPrimaryKey('persons', 'perdepPK');

        $this->assertSame("ALTER TABLE persons DROP  CONSTRAINT  perdepPK;", trim(DBForge::stringQuery()));
    }
}