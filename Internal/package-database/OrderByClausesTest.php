<?php namespace ZN\Database;

use DB;

class OrderByClausesTest extends DatabaseExtends
{
    public function testOrderByField()
    {
        $query = DB::string()->orderByField('name', ['Susan', 'John', 'Micheal'])->persons();

        $this->assertSame("SELECT  *  FROM persons  ORDER BY FIELD(name, 'Susan', 'John', 'Micheal')", trim($query));
    }

    public function testOrderByRandom()
    {
        $query = DB::string()->orderByRandom()->persons();

        $this->assertSame("SELECT  *  FROM persons  ORDER BY rand()", trim($query));
    }
}