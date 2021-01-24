<?php namespace ZN\Database;

use DB;
use Config;
use DBForge;

class UpdateTest extends \PHPUnit\Framework\TestCase
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

    public function testUpdate()
    {
        DB::where('id', 1)->update('persons', 
        [
            'surname' => 'Orlando'
        ]);

        $person = DB::where('id', 1)->persons()->row();

        $this->assertSame('Orlando', $person->surname);
    }

    public function testIncrement()
    {
        $first = DB::where('id', 1)->persons()->row();

        DB::where('id', 1)->increment('persons', 'phone', 10);

        $last = DB::where('id', 1)->persons()->row();

        $this->assertSame((float) $last->phone, (float) $first->phone + 10);
    }

    public function testDecrement()
    {
        $first = DB::where('id', 1)->persons()->row();

        DB::where('id', 1)->decrement('persons', 'phone', 10);

        $last = DB::where('id', 1)->persons()->row();

        $this->assertSame((float) $last->phone, (float) $first->phone - 10);
    }
}