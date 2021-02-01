<?php namespace ZN\Database;

use DBForge;

class DropTableTest extends DatabaseExtends
{
    public function testDropTable()
    {
        DBForge::dropTable('contents');

        $this->assertSame("DROP TABLE contents", trim(DBForge::stringQuery()));
    }
}