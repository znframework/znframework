<?php namespace ZN\Database;

use DB;

class CachingTest extends Test\Constructor
{
    public function testCaching()
    {
        DB::caching('8 minutes')->persons()->result();
        DB::caching('8 minutes')->groupBy('name')->persons()->result();
    }

    public function testCleanCaching()
    {
        $person = DB::persons();
        
        $person->cleanCaching();

        $person2 = DB::groupBy('name')->persons();

        $person2->cleanCaching();
    }
}