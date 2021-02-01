<?php namespace ZN\Database;

use DB;

class ExecTest extends DatabaseExtends
{
    public function testExecQuery()
    {
        $status = DB::execQuery("INSERT INTO persons (name) VALUES ('Malup')");

        $this->assertTrue($status);

        DB::where('name', 'Malup')->delete('persons');
    }

    public function testMultiQuery()
    {
        $status = DB::execQuery("INSERT INTO persons (name) VALUES ('Hallop'); INSERT INTO persons (name) VALUES ('Morello')");

        $this->assertTrue($status);

        DB::where('name', 'Hallop', 'or')->where('name', 'Morello')->delete('persons');
    }
}