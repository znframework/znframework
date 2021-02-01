<?php namespace ZN\Database;

use DBForge;

class AddPrimaryKeyTest extends DatabaseExtends
{
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
}