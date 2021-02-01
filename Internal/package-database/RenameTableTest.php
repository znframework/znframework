<?php namespace ZN\Database;

use DBForge;

class RenameTableTest extends DatabaseExtends
{
    public function testRenameTable()
    {
        DBForge::renameTable('contents', 'contentsnew');

        $this->assertSame("ALTER TABLE contents RENAME TO contentsnew", trim(DBForge::stringQuery()));
    }
}