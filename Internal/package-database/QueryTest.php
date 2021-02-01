<?php namespace ZN\Database;

use DB;

class QueryTest extends DatabaseExtends
{
    public function testSelectPersonWithQuery()
    {
        $person = DB::query('select * from persons where name = "Ahri"');

        $this->assertEquals('select * from persons where name = "Ahri"', $person->stringQuery());
    }

    public function testQueryWithSecure()
    {
        $person = DB::secure(['x:' => 'Ahri'])->query('select * from persons where name = x:');

        $this->assertEquals("select * from persons where name = 'Ahri'", $person->stringQuery());
    }
}