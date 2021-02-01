<?php namespace ZN\Database;

use DBForge;

class DropIndexTest extends DatabaseExtends
{
    public function testDropIndex()
    {
        DBForge::dropIndex('departmentCI', 'departments', 'description');

        $this->assertSame("ALTER TABLE departments DROP INDEX departmentCI;", trim(DBForge::stringQuery()));
    }
}