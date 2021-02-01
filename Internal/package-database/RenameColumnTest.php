<?php namespace ZN\Database;

use DB;
use DBForge;

class ForgeColumnTest extends DatabaseExtends
{
    public function testRenameColumn()
    {
        DBForge::renameColumn('ExapleTable', ['phone mobile_phone' => [DB::int(), DB::notNull()]]);

        # Unsported SQLite3
        $this->assertSame("", trim(DBForge::stringQuery()));
    }
}