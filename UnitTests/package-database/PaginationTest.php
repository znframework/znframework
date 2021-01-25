<?php namespace ZN\Database;

use DB;

class PaginationTest extends Test\Constructor
{
    public function testCratePagination()
    {
        $persons = DB::limit(NULL, 1)->persons();

        $this->assertIsString($persons->pagination());
    }
}