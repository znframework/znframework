<?php namespace ZN\Database;

use DBTool;

class ToolTest extends DatabaseExtends
{
    public function testListDatabases()
    {
        $result = DBTool::listDatabases();

        $this->assertSame([\ZN\Test\GlobalExtends::default . 'package-database/testdb'], $result);
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
        $result = DBTool::import(self::default . 'package-database/resources/test.sql');

       $this->assertIsBool($result);
    }
}