<?php namespace ZN\Database;

use DB;
use DBForge;

class AddColumnTest extends DatabaseExtends
{
    public function testAddColumn()
    {
        DBForge::createTable('students', 
        [
            'name' => [DB::varchar(255), DB::primaryKey()]
        ]);

        DBForge::addColumn('students' , 
        [
            'phone' => [DB::int(11), DB::notNull()]
        ]);

        $columns = DB::students()->columns();

        $this->assertIsArray($columns);

        DBForge::dropTable('students');
    }

    public function testAddColumnStringParameter()
    {
        DBForge::createTable('students', 
        [
            'name' => [DB::varchar(255), DB::primaryKey()]
        ]);

        DBForge::addColumn('students' , 
        [
            'phone' => 'INTEGER(11) NOT NULL'
        ]);

        $columns = DB::students()->columns();

        $this->assertIsArray($columns);

        DBForge::dropTable('students');
    }

    public function testAddColumnOptionalParameter()
    {
        DBForge::createTable('students', 
        [
            'name' => [DB::varchar(255), DB::primaryKey()]
        ]);

        DBForge::column('phone', [DB::int(11)])->addColumn('students');

        $columns = DB::students()->columns();

        $this->assertEquals(['name', 'phone'], $columns);

        DBForge::dropTable('students');
    }
}