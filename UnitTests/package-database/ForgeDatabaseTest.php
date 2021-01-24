<?php namespace ZN\Database;

use DB;
use Config;
use DBTool;
use DBForge;

class ForgeDatabaseTest extends \PHPUnit\Framework\TestCase
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

    public function testCreateDatabase()
    {
        DBForge::createDatabase('contents');

        $this->assertSame("CREATE DATABASE contents", trim(DBForge::stringQuery()));
    }

    public function testCreateDatabaseExtras()
    {
        DBForge::createDatabase('contents', 'Extras Query');

        $this->assertSame("CREATE DATABASE contents Extras Query;", trim(DBForge::stringQuery()));
    }

    public function testDropDatabase()
    {
        DBForge::dropDatabase('contents');

        $this->assertSame("DROP DATABASE contents", trim(DBForge::stringQuery()));
    }
}