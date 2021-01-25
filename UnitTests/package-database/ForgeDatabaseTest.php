<?php namespace ZN\Database;

use DBForge;

class ForgeDatabaseTest extends Test\Constructor
{
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