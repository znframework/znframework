<?php namespace ZN\Database;

use DB;
use Config;

class OrderByClausesTest extends \PHPUnit\Framework\TestCase
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
    }

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