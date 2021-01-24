<?php namespace ZN\Database;

use URI;
use File;
use Json;
use Config;
use Get, Post, Request;
use DB, DBForge, DBTool;

class DBTest extends \PHPUnit\Framework\TestCase
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

    public function testCreatePersonsTable()
    {   
        if( ! in_array('persons', DBTool::listTables()) )
        {
            DBForge::createTable('persons', 
            [
                'id'      => [DB::int(11), DB::primaryKey()],
                'name'    => [DB::varchar(255)],
                'surname' => [DB::varchar(255)],
                'phone'   => [DB::varchar(255)]
            ]);

            $this->assertTrue(true);
        }
        else
        {
            $this->assertFalse(false);
        }
    }   

    public function testInsertPerson()
    {
        $status = DB::insert('persons', 
        [
            'id'      => 1,
            'name'    => 'Micheal',
            'surname' => ''
        ]);

        $totalRows = DB::where('id', 1)->persons()->totalRows();

        $this->assertSame(1, $totalRows);
    }

    public function testSelectPerson()
    {
        $row = DB::where('id', 1)->persons()->row();

        $this->assertSame('Micheal', $row->name);
    }

    public function testSelectPersonColumns()
    {
        $row = DB::select('id', 'name')->persons()->row();

        $columns = array_keys((array) $row);

        $this->assertSame(['id', 'name'], $columns);
    }

    public function testSelectPersonWithWhereEqualClause()
    {
        $row = DB::where('name', 'Micheal')->persons()->row();

        $this->assertSame('Micheal', $row->name);
    }

    public function testSelectPersonsWithWhereNotEqualClause()
    {
        $row = DB::where('name !=', 'Micheal')->persons()->row();

        $name = $row->name ?? '';

        $this->assertTrue('Micheal' != $name);
    }

    public function testSelectPersonWithWhereOtherOperatorClause()
    {
        $row = DB::where('id <', 2)->persons()->row();

        $this->assertSame('Micheal', $row->name);
    }

    public function testSelectPersonWithMultipleWhereAndClauses()
    {
        $row = DB::where('id', 1)->where('name', 'Micheal')->persons()->row();

        $this->assertSame('Micheal', $row->name);
    }

    public function testSelectPersonWithMultipleWhereOrClauses()
    {
        $row = DB::where('id', 1, 'or')->where('name', 'Micheal')->persons()->row();

        $this->assertSame('Micheal', $row->name);
    }

    public function testSelectPersonWithMultipleOneWhereClauses()
    {
        $row = DB::where
        ([
            ['id', 1, 'or'], 
            ['name', 'Micheal']
        ])->persons()->row();

        $this->assertSame('Micheal', $row->name);
    }

    public function testWhereColumnConvertToInt()
    {
        $normal = DB::string()->where('id', 1)->users();

        $this->assertSame("SELECT  *  FROM users  WHERE id =  '1' ", $normal);

        $toInt = DB::string()->where('int:id', 1)->users();

        $this->assertSame("SELECT  *  FROM users  WHERE id =  1 ", $toInt);
    }

    public function testWhereColumnConvertToFloat()
    {
        $normal = DB::string()->where('price >', '100.00')->prices();

        $this->assertSame("SELECT  *  FROM prices  WHERE price > '100.00' ", $normal);

        $toFloat = DB::string()->where('float:price >', '100.00')->prices();

        $this->assertSame("SELECT  *  FROM prices  WHERE price > 100 ", $toFloat);
    }

    public function testWhereColumnConvertToNonquotes()
    {
        $normal = DB::string()->where('price >', 'COUNT(price)')->prices();

        $this->assertSame("SELECT  *  FROM prices  WHERE price > 'COUNT(price)' ", $normal);

        $toExp = DB::string()->where('exp:price >', 'COUNT(price)')->prices();

        $this->assertSame("SELECT  *  FROM prices  WHERE price > COUNT(price) ", $toExp);
    }

    public function testWhereGroup()
    {
        $stringQuery = DB::string()->whereGroup
        (
            ['id', 1, 'or'],
            ['id', 2],
            'and'
        )
        ->whereGroup
        (
            ['name', 'ZN', 'and'],
            ['address', 'Istanbul']  
        )
        ->users(); 

        $this->assertSame("SELECT  *  FROM users  WHERE ( id =  '1' or  id =  '2'  ) and  ( name =  'ZN' and  address =  'Istanbul'  ) ", $stringQuery);
    }

    public function testHaving()
    {
        $stringQuery = DB::string()->having('price >', '100')->prices();

        $this->assertSame("SELECT  *  FROM prices  HAVING price > '100' ", $stringQuery);
    }

    public function testHavingGroup()
    {
        $stringQuery = DB::string()->havingGroup
        (
            ['id', 1, 'or'],
            ['id', 2],
            'and'
        )
        ->havingGroup
        (
            ['name', 'ZN', 'and'],
            ['address', 'Istanbul']  
        )
        ->users(); 

        $this->assertSame("SELECT  *  FROM users  HAVING ( id =  '1' or  id =  '2'  ) and  ( name =  'ZN' and  address =  'Istanbul'  ) ", $stringQuery);
    }

    public function testGroupBy()
    {
        $stringQuery = DB::string()->groupBy('name')->users();

        $this->assertSame('SELECT  *  FROM users  GROUP BY name', $stringQuery);
    }

    public function testOrderBy()
    {
        $stringQuery = DB::string()->orderBy('id', 'DESC')->where('id >', 10)->users();

        $this->assertSame("SELECT  *  FROM users  WHERE id > '10'  ORDER BY id DESC", $stringQuery);
    }

    public function testMultipleOrderBy()
    {
        $stringQuery = DB::string()->orderBy(['name' => 'asc', 'country' => 'desc'])->users();

        $this->assertSame("SELECT  *  FROM users  ORDER BY name asc, country desc", $stringQuery);
    }

    public function testLimit()
    {
        $stringQuery = DB::string()->limit(10)->users();

        $this->assertSame("SELECT  *  FROM users  LIMIT 10", $stringQuery);
    }

    public function testLimitStart()
    {
        $stringQuery = DB::string()->limit(5, 10)->users();

        $this->assertSame("SELECT  *  FROM users  LIMIT 10 OFFSET 5 ", $stringQuery);
    }

    public function testGet()
    {
        $person = DB::get('persons')->row();

        $this->assertSame('Micheal', $person->name);
    }

    public function testResult()
    {
        DB::insert('persons', 
        [
            'id' => 2,
            'name' => 'John'
        ]);

        $result = DB::persons()->result();

        $this->assertSame('John', $result[1]->name);
    }

    public function testTableNameResult()
    {
        $result = DB::personsResult();

        $this->assertSame('Micheal', $result[0]->name);
    }
    
    public function testResultArray()
    {
        $result = DB::persons()->resultArray();

        $this->assertSame('Micheal', $result[0]['name']);
    }

    public function testResultJson()
    {
        $result = DB::persons()->resultJson();

        $this->assertTrue(Json::check($result));

        $this->assertSame('Micheal', json_decode($result)[0]->name);
    }

    public function testJsonDecode()
    {
        DB::where('id', 1)->update('persons', 
        [
            'phone' => ['a' => '12345', 'b' => '22334']
        ]);
        
        $person = DB::where('id', 1)->jsonDecode('phone')->persons()->row();

        $this->assertSame('12345', $person->phone->a);
    }

    public function testSelectPersonSingleFirstRow()
    {
        $person = DB::persons()->row();

        $this->assertSame('Micheal', $person->name);
    }

    public function testSelectPersonSingleRowByIndex()
    {
        $person = DB::persons()->row(1);

        $this->assertSame('John', $person->name);
    }

    public function testSelectPersonSingleRowByLastIndex()
    {
        $person = DB::where('id <', 3)->persons()->row(-1);

        $this->assertSame('John', $person->name);
    }

    public function testSelectPersonOnlyColumnValue()
    {
        $person = DB::select('name')->where('id', 1)->persons()->row(true);

        $this->assertSame('Micheal', $person);
    }

    public function testTableNameRow()
    {
        $row = DB::personsRow();

        $this->assertSame('Micheal', $row->name);
    }

    public function testGetColumnValue()
    {
        $name = DB::where('id', 1)->persons()->value('name');

        $this->assertSame('Micheal', $name);
    }

    public function testGetColumnValueWithoutSelect()
    {
        $firstColumnValue = DB::where('id', 1)->persons()->value();

        $this->assertSame(1, $firstColumnValue); # id
    }

    public function testSelectPersonTotalRows()
    {
        $totalRows = DB::limit(1)->persons()->totalRows();

        $this->assertSame(1, $totalRows);
    }
    
    public function testSelectPersonRealTotalRows()
    {
        $person = DB::limit(1)->persons();

        $this->assertGreaterThan($person->totalRows(), $person->totalRows(true));
    }

    public function testGetTotalColumns()
    {
        $totalColumns = DB::persons()->totalColumns();

        $this->assertSame(4, $totalColumns);
    }

    public function testGetColumns()
    {
        $columns = DB::persons()->columns();

        $this->assertContains('name', $columns);
    }

    public function testGetColumnData()
    {
        $columns = DB::persons()->columnData();

        $this->assertArrayHasKey('name', $columns);
    }

    public function testGetTableName()
    {
        $person = DB::persons();

        $this->assertSame('persons', $person->tableName());
    }

    public function testCratePagination()
    {
        $persons = DB::limit(NULL, 1)->persons();

        $this->assertIsString($persons->pagination());
    }

    public function testIsExists()
    {
        $this->assertTrue(DB::isExists('persons', 'id', 1));
        $this->assertFalse(DB::isExists('persons', 'name', 'Samanta'));
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
        $status = DB::personsInsert
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
        $status = DB::where(11)->update('persons',
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

    public function testUpdate()
    {
        DB::where('id', 1)->update('persons', 
        [
            'surname' => 'Orlando'
        ]);

        $person = DB::where('id', 1)->persons()->row();

        $this->assertSame('Orlando', $person->surname);
    }

    public function testDelete()
    {
        DB::where('id', 12)->delete('persons');

        $person = DB::where('id', 12)->persons()->row();

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

    public function testTransactionQueriesUnsuccess()
    {
        $return = DB::transaction(function()
        {      
            DB::insert('personsx', ['name' => 'John']);
            DB::where('id', 1)->update('persons', ['phone' => '1234']);
        });

        $person = DB::where('id', 1)->persons()->row();

        $this->assertFalse($person->phone == '1234');
    }

    public function testTransactionQueriesSuccess()
    {
        if( ! DB::isExists('persons', 'name', 'Ahri') )
        {
            DB::transaction(function()
            {      
                DB::insert('persons', 
                [
                    'name' => 'Ahri'
                ]);
    
                DB::where('id', 1)->update('persons', ['phone' => '1000']);
            });

            $person = DB::where('id', 1)->persons()->row();

            $this->assertTrue($person->phone == '1000');
        }
        else
        {
            $this->assertTrue(true);
        } 
    }

    public function testIncrement()
    {
        $first = DB::where('id', 1)->persons()->row();

        DB::where('id', 1)->increment('persons', 'phone', 10);

        $last = DB::where('id', 1)->persons()->row();

        $this->assertSame((float) $last->phone, (float) $first->phone + 10);
    }

    public function testSelectPersonWithQuery()
    {
        $person = DB::query('select * from persons where id = 1')->row();

        $this->assertIsObject($person);
    }

    public function testQueryWithSecure()
    {
        $person = DB::secure(['x:' => 1])->query('select * from persons where id = x:')->row();

        $this->assertIsObject($person);
    }

    public function testExecQuery()
    {
        $status = DB::execQuery("INSERT INTO persons (id, name) VALUES (20, 'Morgana')");

        $this->assertIsBool($status);
    }

    public function testMultiQuery()
    {
        $status = DB::execQuery("INSERT INTO persons (id, name) VALUES (21, 'Olaf'); INSERT INTO persons (id, name) VALUES (22, 'Jarvan')");

        $this->assertIsBool($status);
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