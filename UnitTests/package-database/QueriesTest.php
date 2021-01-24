<?php namespace ZN\Database;

use DB;
use Config;
use DBForge;

class QueriesTest extends \PHPUnit\Framework\TestCase
{
    public function __construct()
    {
        parent::__construct();

        Config::database('database', 
        [
            'driver'   => 'sqlite',
            'database' => 'UnitTests/package-database/testdb',
            'password' => '1234'
        ]);

        DBForge::createTable('persons', 
        [
            'id'      => [DB::int(11), DB::primaryKey()],
            'name'    => [DB::varchar(255)],
            'surname' => [DB::varchar(255)],
            'phone'   => [DB::varchar(255)]
        ]);
    }


    public function testTransactionQueriesUnsuccess()
    {
        $return = DB::transaction(function()
        {      
            DB::insert('personsx', ['name' => 'John']);
            DB::where('id', 1)->update('persons', ['phone' => '1234']);
        });

        $person = DB::where('id', 1)->persons()->row();

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
    
                DB::where('id', 1)->update('persons', ['phone' => '1000']);
            });

            $person = DB::where('id', 1)->persons()->row();

            $this->assertTrue($person->phone == '1000');
        }
        else
        {
            $this->assertTrue(true);
        } 
    }

    public function testSelectPersonWithQuery()
    {
        $person = DB::query('select * from persons where id = 1')->row();

        $this->assertIsObject($person);
    }

    public function testQueryWithSecure()
    {
        $person = DB::secure(['x:' => 1])->query('select * from persons where id = x:')->row();

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