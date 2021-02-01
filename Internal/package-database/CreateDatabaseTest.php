<?php namespace ZN\Database;

use DBForge;

class CreateDatabaseTest extends DatabaseExtends
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
}