<?php namespace ZN\Database;

use DB;
use DBForge;

class DropColumnTest extends DatabaseExtends
{
    public function testDropColumn()
    {
        DBForge::createTable('students', 
        [
            'name'  => [DB::varchar(255), DB::primaryKey()],
            'phone' => [DB::int(11), DB::notNull()]
        ]);

        # SQLite3 Unsupported
        DBForge::dropColumn('students', ['phone']);

        $columns = DB::students()->columns();

        $this->assertEquals(['name', 'phone'], $columns);

        DBForge::dropTable('students');
    }
}