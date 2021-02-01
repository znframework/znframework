<?php namespace ZN\Database;

use DBForge;

class DropDatabaseTest extends DatabaseExtends
{
    public function testDropDatabase()
    {
        DBForge::dropDatabase('contents');

        $this->assertSame("DROP DATABASE contents", trim(DBForge::stringQuery()));
    }
}