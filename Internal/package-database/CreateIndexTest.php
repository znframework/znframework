<?php namespace ZN\Database;

use DBForge;

class CreateIndexTest extends DatabaseExtends
{
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
}