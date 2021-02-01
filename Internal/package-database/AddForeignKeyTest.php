<?php namespace ZN\Database;

use DB;
use DBForge;

class AddForeignKeyTest extends DatabaseExtends
{
    public function testAddForeignKey()
    {
        DBForge::addForeignKey('persons', 'department_id', 'department', 'id', 'perdepFK');

        $this->assertSame
        (
            "ALTER TABLE persons ADD  CONSTRAINT  perdepFK  FOREIGN KEY (department_id) REFERENCES department(id);", 
            trim(DBForge::stringQuery())
        );
    }
}