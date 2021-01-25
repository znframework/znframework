<?php namespace ZN\Database;

use Config;
use DBTool;

class ToolTest extends \PHPUnit\Framework\TestCase
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

    public function testListDatabases()
    {
        $result = DBTool::listDatabases();

        $this->assertSame(['UnitTests/package-database/testdb'], $result);
    }

    public function testListTables()
    {
        $result = DBTool::listTables();
        
        $this->assertIsArray($result);
    }

    public function testStatusTables()
    {
        $result = DBTool::statusTables();

        $this->assertFalse($result);
    }

    public function testOptimizeTables()
    {
        $result = DBTool::optimizeTables();

        $this->assertFalse($result);
    }

    public function testRepairTables()
    {
        $result = DBTool::repairTables();

        $this->assertFalse($result);
    }

    public function testBackup()
    {
        $result = DBTool::backup();

        $this->assertFalse($result);
    }

    public function testImport()
    {
        $result = DBTool::import('UnitTests/package-database/test.sql');

       $this->assertIsBool($result);
    }
}