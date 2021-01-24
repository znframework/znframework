<?php namespace ZN\Database;

use DB;
use Config;
use DBForge;

class CachingTest extends \PHPUnit\Framework\TestCase
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