<?php namespace ZN\Database;

use DB;

class QueriesTest extends DatabaseExtends
{
    public function testSelectPersonWithQuery()
    {
        $person = DB::query('select * from persons where name = "Ahri"')->row();

        $this->assertIsObject($person);
    }

    public function testQueryWithSecure()
    {
        $person = DB::secure(['x:' => 'Ahri'])->query('select * from persons where name = x:')->row();

        $this->assertIsObject($person);
    }

    public function testExecQuery()
    {
        $status = DB::execQuery("INSERT INTO persons (id, name) VALUES (20, 'Morgana')");

        $this->assertIsBool($status);
    }

    public function testMultiQuery()
    {
        $status = DB::execQuery("INSERT INTO persons (id, name) VALUES (21, 'Olaf'); INSERT INTO persons (id, name) VALUES (22, 'Jarvan')");

        $this->assertIsBool($status);
    }
}