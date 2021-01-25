<?php namespace ZN\Database;

use DB;

class QueriesTest extends Test\Constructor
{
    public function testTransactionQueriesUnsuccess()
    {
        $return = DB::transaction(function()
        {      
            DB::insert('personsx', ['name' => 'John']);
            DB::where('name', 'Haluk')->update('persons', ['phone' => '1234']);
        });

        $person = DB::where('name', 'Haluk')->persons()->row();

        $this->assertFalse($person->phone == '1234');
    }

    public function testTransactionQueriesSuccess()
    {
        if( ! DB::isExists('persons', 'name', 'Ahri') )
        {
            DB::transaction(function()
            {      
                DB::insert('persons', 
                [
                    'name' => 'Ahri'
                ]);
    
                DB::where('name', 'Haluk')->update('persons', ['phone' => '1000']);
            });

            $person = DB::where('name', 'Haluk')->persons()->row();

            $this->assertTrue($person->phone == '1000');
        }
        else
        {
            $this->assertTrue(true);
        } 
    }

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