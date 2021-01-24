<?php namespace ZN\Database;

use DB;
use Get;
use Post;
use File;
use Json;
use Config;
use DBForge;
use Request;

class InsertTest extends \PHPUnit\Framework\TestCase
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

    public function testInsertData()
    {
        DB::insert('persons', 
        [
            'id' => 3,
            'name' => 'Ozan'
        ]);

        $person = DB::where('id', 3)->persons()->row();

        $this->assertSame('Ozan', $person->name);
    }

    public function testInsertDuplicateCheck()
    {
        $status = DB::duplicateCheck('name')->insert('persons', 
        [
            'id'      => 4,
            'name'    => 'Ozan',
            'surname' => 'Uykun'
        ]);

        $this->assertFalse($status);
    }

    public function testInsertDuplicateCheckUpdate()
    {
        DB::duplicateCheckUpdate('name')->insert('persons', 
        [
            'name'    => 'Ozan',
            'surname' => 'Uykun'
        ]);

        $person = DB::where('id', 3)->persons()->row();

        $this->assertSame('Uykun', $person->surname);
    }

    public function testInsertWithOptionalMethods()
    {
        DB::column('id', 4)
          ->column('name', 'Haluk')
          ->insert('persons');

        $person = DB::where('id', 4)->persons()->row();

        $this->assertSame('Haluk', $person->name);
    }

    public function testInsertIgnoreMatch()
    {
        $data = 
        [
            'id'      => 5,
            'name'    => 'Susan',
            'address' => 'Paris' # unknown column
        ];

        # In this use, the id key in the incoming array is eliminated.
        DB::duplicateCheck('name')->insert('ignore:persons', $data);

        $person = DB::where('name', 'Susan')->persons()->row();

        $this->assertSame('Susan', $person->name);

        DB::where('name', 'Susan')->update('persons', ['id' => 5]);
    }

    public function testInsertPostMatch()
    {
        Post::name('Marlon');
        Post::surname('Brando');

        DB::duplicateCheck('name')->insert('post:persons');

        $person = DB::where('name', 'Marlon')->persons()->row();

        $this->assertSame('Marlon', $person->name);

        DB::where('name', 'Marlon')->update('persons', ['id' => 6]);
    }

    public function testInsertGetMatch()
    {
        Get::name('Jessie');

        DB::duplicateCheck('name')->insert('get:persons');

        $person = DB::where('name', 'Jessie')->persons()->row();

        $this->assertSame('Jessie', $person->name);

        DB::where('name', 'Jessie')->update('persons', ['id' => 7]);
    }

    public function testInsertRequestMatch()
    {
        Request::name('Hulk');
        Request::surname('Hogan');

        DB::duplicateCheck('name')->insert('request:persons');

        $person = DB::where('name', 'Hulk')->persons()->row();

        $this->assertSame('Hulk', $person->name);

        DB::where('name', 'Hulk')->update('persons', ['id' => 8]);
    }

    public function testInsertArrayToJson()
    {
        DB::insert('persons', 
        [
            'id'    => 9,
            'name'  => 'Jonnie',
            'phone' => ['4433', '3322'] # to Json
        ]);

        $person = DB::where('id', 9)->persons()->row();

        $this->assertTrue(Json::check($person->phone));
    }

    public function testInsertTableName()
    {
        DB::personsInsert
        ([
            'id'    => 10,
            'name'  => 'Elon'
        ]);

        $person = DB::where('id', 10)->persons()->row();

        $this->assertSame('Elon', $person->name);
    }

    public function testGetInsertId()
    {
        DB::personsInsert
        ([
            'id'    => 11,
            'name'  => 'James'
        ]);

        if( $insertId = DB::insertId() )
        {
            $this->assertSame(11, $insertId);
        }

        echo $insertId;
    }

    public function testGetAffectedRows()
    {
        DB::where(11)->update('persons',
        [
            'name'  => 'James'
        ]);

        if( $affectedRows = DB::affectedRows() )
        {
            $this->assertSame(1, $affectedRows);
        }

        echo $affectedRows;
    }

    public function testInsertCSVFile()
    {
        DB::insertCSV('persons', 'UnitTests/package-database/test.csv');

        $person = DB::where('name', 'Darius')->persons()->row();

        $this->assertSame('Darius', $person->name);
    }
}