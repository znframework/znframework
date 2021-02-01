<?php namespace ZN\Database;

use DBForge;

class CreateDatabaseTest extends DatabaseExtends
{
    public function testCreateDatabase()
    {
        DBForge::createDatabase('contents');

        $this->assertSame("CREATE DATABASE contents", trim(DBForge::stringQuery()));
    }
}