<?php namespace ZN\Database;

use DBForge;

class TruncateTableTest extends DatabaseExtends
{
    public function testTruncateTable()
    {
        DBForge::truncate('contents');

        # For SQLite3
        $this->assertSame("DELETE FROM contents", trim(DBForge::stringQuery()));
    }
}