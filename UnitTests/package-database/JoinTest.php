<?php namespace ZN\Database;

use DB;
use Config;

class JoinTest extends \PHPUnit\Framework\TestCase
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

    public function testInnerJoin()
    {
        $query = DB::string()->innerJoin('addresses.person_name', 'persons.name')->persons();

        $this->assertSame('SELECT  *  FROM persons  INNER JOIN addresses ON addresses.person_name = persons.name  ', $query);
    }

    public function testOuterJoin()
    {
        $query = DB::string()->outerJoin('addresses.person_name', 'persons.name')->persons();

        $this->assertSame('SELECT  *  FROM persons  FULL OUTER JOIN addresses ON addresses.person_name = persons.name  ', $query);
    }

    public function testLeftJoin()
    {
        $query = DB::string()->leftJoin('addresses.person_name', 'persons.name')->persons();

        $this->assertSame('SELECT  *  FROM persons  LEFT JOIN addresses ON addresses.person_name = persons.name  ', $query);
    }

    public function testRightJoin()
    {
        $query = DB::string()->rightJoin('addresses.person_name', 'persons.name')->persons();

        $this->assertSame('SELECT  *  FROM persons  RIGHT JOIN addresses ON addresses.person_name = persons.name  ', $query);
    }

    public function testUnion()
    {
        $query = DB::select('person_name', 'address')->unionAll('addresses')->string()->select('name', 'surname')->persons();

        $this->assertSame('SELECT  person_name,address  FROM addresses UNION ALL SELECT  name,surname  FROM persons ', $query);
    }
}