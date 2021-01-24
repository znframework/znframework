<?php namespace ZN\Console;

use DB;
use File;
use Config;
use Folder;
use DBForge;

class ModelTest extends \PHPUnit\Framework\TestCase
{
    public function __construct()
    {
        parent::__construct();

        Config::database('database', 
        [
            'driver'   => 'sqlite',
            'database' => 'UnitTests/package-console/testdb',
            'password' => '1234'
        ]);

        DBForge::createTable('persons', 
        [
            'name'    => [DB::varchar(255)],
            'surname' => [DB::varchar(255)],
            'phone'   => [DB::varchar(255)]
        ]);
    }

    public function testCreateModel()
    {
        new CreateModel('Example1');

        $this->assertFileExists($file = MODELS_DIR . 'Example1.php');

        if( is_file($file) )
        {
            File::delete($file);
        }
    }

    public function testCreateGrandModel()
    {
        new CreateGrandModel('Example');

        $this->assertFileExists($file = MODELS_DIR . 'Example.php');

        if( is_file($file) )
        {
            File::delete($file);
        }
    }

    public function testCreateGrandVision()
    {
        new CreateGrandVision('testdb');
    }

    public function testDeleteGrandVision()
    {
        new DeleteGrandVision('testdb');
    }

    public function testCreateMigration()
    {
        new CreateMigration('Persons', [0]);

        $this->assertFileExists($file = MODELS_DIR . 'Migrations/Persons.php');

        if( is_file($file) )
        {
            File::delete($file);
        }
    }

    public function testCreateMigrationOtherVersion()
    {
        new CreateMigration('Persons', [2]);

        $this->assertFileExists($file = MODELS_DIR . 'Migrations/PersonsVersion/002.php');

        if( is_dir($dir = MODELS_DIR . 'Migrations/PersonsVersion') )
        {
            Folder::delete($dir);
        }
    }

    public function testDeleteModel()
    {
        new CreateModel('Example');
        new DeleteModel('Example');

        $file = MODELS_DIR . 'Example.php';

        if( is_file($file) )
        {
            $this->assertTrue(false);
        }
        else
        {
            $this->assertTrue(true);
        }
    }

    public function testDeleteMigration()
    {
        new CreateMigration('Persons');
        new DeleteMigration('Persons');

        $file = MODELS_DIR . 'Migrations/Persons.php';

        if( is_file($file) )
        {
            $this->assertTrue(false);
        }
        else
        {
            $this->assertTrue(true);
        }
    }

    public function testDeleteMigrationAll()
    {
        new CreateMigration('Persons');
        new DeleteMigrationAll();

        $file = MODELS_DIR . 'Migrations/Persons.php';

        if( is_file($file) )
        {
            $this->assertTrue(false);
        }
        else
        {
            $this->assertTrue(true);
        }
    }
}