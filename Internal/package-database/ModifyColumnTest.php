<?php namespace ZN\Database;

use DB;
use DBForge;

class ModifyColumnTest extends DatabaseExtends
{
    public function testModifyColumn()
    {
        DBForge::modifyColumn('ExampleTable', ['phone' => [DB::int(), DB::notNull()]]); 

        # Unsported SQLite3
        $this->assertSame("", trim(DBForge::stringQuery()));
    }
}