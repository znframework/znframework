<?php namespace ZN\Database;

use Config;
use DBTrigger;

class TriggerTest extends \PHPUnit\Framework\TestCase
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

    public function testCreate()
    {
        DBTrigger::table('exampleTable')
         ->when('before')
         ->event('insert')
         ->body('INSERT ... QUERY', 'UPDATE ... QUERY')
         ->create('exampleTrigger');

        $this->assertSame("CREATE  TRIGGER exampleTrigger before insert ON exampleTable FOR EACH ROW  BEGIN INSERT ... QUERY; UPDATE ... QUERY; END;", trim(DBTrigger::stringQuery()));
    }

    public function testDrop()
    {
        DBTrigger::drop('exampleTrigger');

        $this->assertSame("DROP TRIGGER exampleTrigger", trim(DBTrigger::stringQuery()));
    }

    public function testList()
    {
        DBTrigger::list('exampleTrigger');

        $this->assertSame('SELECT * FROM information_schema.triggers WHERE TRIGGER_NAME = "exampleTrigger"', trim(DBTrigger::stringQuery()));
    }

    public function testExists()
    {
        DBTrigger::exists('exampleTrigger');

        $this->assertSame('SELECT * FROM information_schema.triggers WHERE TRIGGER_NAME = "exampleTrigger"', trim(DBTrigger::stringQuery()));
    }
}