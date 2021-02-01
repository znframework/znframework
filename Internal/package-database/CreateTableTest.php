<?php namespace ZN\Database;

use DB;
use DBForge;

class CreateTableTest extends DatabaseExtends
{
    public function testCreateTable()
    {
        DBForge::createTable('contents', 
        [ 
            'id'   => [DB::int(11), DB::primaryKey()], 
            'name' => [DB::varchar(50),] 
        ]);

        $this->assertSame("CREATE TABLE contents(id   INTEGER(11)  PRIMARY KEY, name   VARCHAR(50))", trim(DBForge::stringQuery()));
    }

    public function testCreateTableExtras()
    {
        DBForge::createTable('contents', 
        [ 
            'id'   => [DB::int(11), DB::primaryKey()], 
            'name' => [DB::varchar(50),] 
        ], 'Extras Query');

        $this->assertSame("CREATE TABLE contents(id   INTEGER(11)  PRIMARY KEY, name   VARCHAR(50)) Extras Query;", trim(DBForge::stringQuery()));
    }

    public function testCreateTableOptionParameters()
    {
        DBForge::column('id', [DB::int(11), DB::notNull(), DB::autoIncrement()])
               ->column('name', [DB::varchar(50), DB::notNull(), DB::collate('utf8_unicode_ci')])
               ->createTable('contents');

        $this->assertSame("CREATE TABLE contents(id   INTEGER(11)  NOT NULL  AUTOINCREMENT, name   VARCHAR(50)  NOT NULL COLLATE utf8_unicode_ci)", trim(DBForge::stringQuery()));
    }
}