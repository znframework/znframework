<?php namespace ZN\Database;

use DBUser;

class UserTest extends DatabaseExtends
{
    public function testCreate()
    {
        DBUser::create('zntr@localhost');

        $this->assertSame("CREATE USER  'zntr'@'localhost'", trim(DBUser::stringQuery()));
    }

    public function testCreateWithPassword()
    {
        DBUser::password('998891')->create('zntr@localhost');

        $this->assertSame("CREATE USER  'zntr'@'localhost'  IDENTIFIED BY  '998891'", trim(DBUser::stringQuery()));
    }

    public function testDrop()
    {
        DBUser::drop('zntr@localhost');

        $this->assertSame("DROP USER  'zntr'@'localhost'", trim(DBUser::stringQuery()));
    }

    public function testAlterWithPassword()
    {
        DBUser::password('998891')->alter('zntr@localhost');

        $this->assertSame("ALTER USER  'zntr'@'localhost'  IDENTIFIED BY  '998891'", trim(DBUser::stringQuery()));
    }

    public function testGrant()
    {
        DBUser::select('db1.*')->name('zn@localhost')->grant('all');

        $this->assertSame("GRANT  all ON  db1.* TO  'zn'@'localhost'", trim(DBUser::stringQuery()));
    }

    public function testRevoke()
    {
        DBUser::select('*.*')->name('zn@localhost')->revoke('insert');

        $this->assertSame("REVOKE  insert ON  *.* FROM  'zn'@'localhost'", trim(DBUser::stringQuery()));
    }

    public function testRename()
    {
        DBUser::rename('zn@localhost', 'zn@127.0.0.1');

        $this->assertSame("RENAME USER  'zn'@'localhost'  TO  'zn'@'127.0.0.1'", trim(DBUser::stringQuery()));
    }
}