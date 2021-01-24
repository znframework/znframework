<?php namespace ZN\Database;

use DB;
use Config;
use DBForge;

class DeleteTest extends \PHPUnit\Framework\TestCase
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

        DBForge::createTable('IF NOT EXISTS persons',
        [
            'name'    => [DB::varchar(255)],
            'surname' => [DB::varchar(255)],
            'phone'   => [DB::varchar(255)]
        ]);
    }

    public function testDelete()
    {
        DB::where('name', 'Ozan')->delete('persons');

        $person = DB::where('name', 'Ozan')->persons()->row();

        $this->assertEmpty($person);
    }

    public function testDeleteUnconditionalException()
    {
        try
        {
            DB::delete('persons');
        }
        catch( Exception\UnconditionalException $exception )
        {
            $this->assertStringStartsWith
            (
                'You can not perform unconditional deletion!',
                $exception->getMessage()    
            );
        }
    }
}