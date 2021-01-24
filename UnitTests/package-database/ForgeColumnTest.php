<?php namespace ZN\Database;

use DB;
use Config;
use DBTool;
use DBForge;

class ForgeColumnTest extends \PHPUnit\Framework\TestCase
{
    public function __construct()
    {
        parent::__construct();

        Config::database('database', 
        [
            'driver'   => 'sqlite',
            'database' => 'UnitTests/package-database/testdb',
            'password' => '1234'
        ]);
    }

    public function testAddColumn()
    {
        DBForge::addColumn('persons' , 
        [
            'phone' => [DB::int(11), DB::notNull()]
        ]);

        $this->assertSame("ALTER TABLE persons ADD phone  INTEGER(11)   NOT NULL ;", trim(DBForge::stringQuery()));
    }

    public function testAddColumnStringParameter()
    {
        DBForge::addColumn('persons' , 
        [
            'phone' => 'INTEGER(11) NOT NULL'
        ]);

        $this->assertSame("ALTER TABLE persons ADD phone INTEGER(11) NOT NULL;", trim(DBForge::stringQuery()));
    }

    public function testAddColumnOptionalParameter()
    {
        DBForge::column('id', [DB::int(11), DB::notNull(), DB::autoIncrement()])
               ->column('name', [DB::varchar(50), DB::notNull(), DB::collate('utf8_unicode_ci')])
               ->addColumn('persons');

        $this->assertSame("ALTER TABLE persons ADD id  INTEGER(11)   NOT NULL   AUTOINCREMENT ,name  VARCHAR(50)   NOT NULL  COLLATE utf8_unicode_ci ;", trim(DBForge::stringQuery()));
    }

    public function testDropColumn()
    {
        DBForge::dropColumn('ExampleTable', ['name' , 'phone']);

        # Unsported SQLite3
        $this->assertSame("", trim(DBForge::stringQuery()));
    }

    public function testRenameColumn()
    {
        DBForge::renameColumn('ExapleTable', ['phone mobile_phone' => [DB::int(), DB::notNull()]]);

        # Unsported SQLite3
        $this->assertSame("", trim(DBForge::stringQuery()));
    }

    public function testModifyColumn()
    {
        DBForge::modifyColumn('ExampleTable', ['phone' => [DB::int(), DB::notNull()]]); 

        # Unsported SQLite3
        $this->assertSame("", trim(DBForge::stringQuery()));
    }

    public function testAddPrimaryKey()
    {
        DBForge::addPrimaryKey('persons', 'id');

        $this->assertSame("ALTER TABLE persons ADD  PRIMARY KEY (id);", trim(DBForge::stringQuery()));
    }

    public function testAddMultiPrimaryKey()
    {
        DBForge::addPrimaryKey('persons', 'id, departmentId', 'perdepPK');

        $this->assertSame("ALTER TABLE persons ADD  CONSTRAINT  perdepPK  PRIMARY KEY (id, departmentId);", trim(DBForge::stringQuery()));
    }

    public function testDropPrimaryKey()
    {
        DBForge::dropPrimaryKey('persons', 'perdepPK');

        $this->assertSame("ALTER TABLE persons DROP  CONSTRAINT  perdepPK;", trim(DBForge::stringQuery()));
    }

    public function testAddForeignKey()
    {
        DBForge::addForeignKey('persons', 'department_id', 'department', 'id', 'perdepFK');

        $this->assertSame("ALTER TABLE persons ADD  CONSTRAINT  perdepFK  FOREIGN KEY (department_id) REFERENCES department(id);", trim(DBForge::stringQuery()));
    }

    public function testDropForeignKey()
    {
        DBForge::dropForeignKey('persons', 'perdepFK');

        $this->assertSame("ALTER TABLE persons DROP  CONSTRAINT perdepFK;", trim(DBForge::stringQuery()));
    }

    public function testCreateIndex()
    {
        DBForge::createIndex('departmentCI', 'departments', 'description');

        $this->assertSame("CREATE  INDEX departmentCI ON departments (description);", trim(DBForge::stringQuery()));
    }

    public function testCreateSpatialIndex()
    {
        DBForge::createSpatialIndex('departmentCI', 'departments', 'description');

        $this->assertSame("CREATE SPATIAL INDEX departmentCI ON departments (description);", trim(DBForge::stringQuery()));
    }

    public function testDropIndex()
    {
        DBForge::dropIndex('departmentCI', 'departments', 'description');

        $this->assertSame("ALTER TABLE departments DROP INDEX departmentCI;", trim(DBForge::stringQuery()));
    }
}