<?php namespace Project\Controllers;

use Config, DB, DBForge, DBTool, DBTrigger, DBUser;

class DatabaseExample extends Controller
{
    protected $database = 'test';

    public function __construct()
    {
        // Change Database
        Config::set('Database', 'database', ['database' => $this->database]);
    }

    public function main(String $params = NULL)
    {
        echo DB::select('name, profile')
               ->sum('login', 'as loginCount')
               ->where('id', 1, 'and')
               ->whereGroup(['name', 'john', 'or'], ['phone !=', '321'])
               ->getString('users');
    }

    public function query()
    {
        $query = DB::query('select * from users');

        output($query->result());
        writeLine('Query Error: '.DB::error());
    }

    public function createDatabase()
    {
        DBForge::createDatabase('examples', DB::encoding('utf8', 'utf8_general_ci'));

        echo DBForge::error();
    }

    public function createTable()
    {
        DBForge::createTable('users',
        [
            'id'      => [DB::int(11), DB::autoIncrement(), DB::primaryKey()],
            'name'    => [DB::varchar(100), DB::null()],
            'phone'   => [DB::varchar(11), DB::null()],
            'address' => [DB::text(), DB::null()]
        ], DB::encoding('utf8', 'utf8_general_ci'));

        echo DBForge::error();
    }

    public function insert()
    {
        // Insert not registered(name and phone) before
        $status = DB::duplicateCheck('name', 'phone')->insert('users',
        [
            'name'    => 'John',
            'phone'   => '555',
            'address' => 'Istanbul'
        ]);

        if( $status === true )
        {
            echo 'Added Data';
        }
        else
        {
            echo 'Data could not be added';
        }
    }

    public function update()
    {
        $status = DB::where('name', 'John')->update('users',
        [
            'address' => 'London'
        ]);

        if( $status === true )
        {
            echo 'Updated Data';
        }
        else
        {
            echo 'Data could not be updated';
        }
    }

    public function select()
    {
        $get = DB::get('users');

        writeLine('Result');

        output($get->result());

        writeLine('Total Rows: '.$get->totalRows());

        writeLine('Where Result');

        $result = DB::where('name !=', 'Ozan')->get('users')->result();

        output($result);
    }

    public function join()
    {
        $join = DB::join('comments', 'comments.user_id = users.id', 'left')
                    ->getString('users');

        writeLine('Join Query: '.$join);

        $leftJoin = DB::leftJoin('comments.user_id', 'users.id')->getString('users');

        writeLine('Join Query: '. $leftJoin);

        // You can create into select a query with getString() method.
    }

    public function delete()
    {
        $status = DB::where('name', 'John')->delete('users');

        if( $status === true )
        {
            echo 'Deleted Data';
        }
        else
        {
            echo 'Data could not be deleted';
        }
    }

    public function dropTable()
    {
        DBForge::dropTable('users');

        echo DBForge::error();
    }

    public function dropDatabase()
    {
        DBForge::dropDatabase('examples');

        echo DBForge::error();
    }

    public function createUser()
    {
        DBUser::password('1234')->create('john@localhost');
    }

    public function dropUser()
    {
        DBUser::drop('john@localhost');
    }

    public function createTrigger()
    {
        DBTrigger::table('users')
                 ->when('AFTER')
                 ->event('INSERT')
                 ->body
                 (
                    DB::string()->insert('users', ['name' => 'Jaime']),
                    DB::string()->where('name', 'Jaime')->update('users', ['name' => 'Halime'])
                 )
                 ->createTrigger('exampleTrigger');

        writeLine('Trigger Query: '.DBTrigger::stringQuery());
        writeLine('Trigger Error: '.DBTrigger::error());
    }

    public function dropTrigger()
    {
        DBTrigger::dropTrigger('exampleTrigger');
    }
}
