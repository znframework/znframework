<?php namespace ZN\Database;

use DBForge;

class DropColumnTest extends DatabaseExtends
{
    public function testDropColumn()
    {
        # SQLite3 Unsupported
        DBForge::dropColumn('students', ['phone']);

        # Unsported SQLite3
        $this->assertSame("", trim(DBForge::stringQuery()));
    }
}