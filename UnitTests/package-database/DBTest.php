<?php namespace ZN\Database;

use DB;
use Config;

class DBTest extends \PHPUnit\Framework\TestCase
{
    public function __construct()
    {
        parent::__construct();

        Config::database('database', 
        [
            'driver'   => 'sqlite',
            'database' => 'UnitTests/testdb',
            'password' => '1234'
        ]);
    }

    public function testSelect()
    {
        echo DB::string()->users();
    }
}