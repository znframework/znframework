<?php namespace ZN\Database;

use DB;
use Get;
use URI;
use Post;
use File;
use Json;
use Config;
use DBForge;
use Request;

class SelectTest extends \PHPUnit\Framework\TestCase
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

    public function testInsertPerson()
    {
        DB::insert('persons', 
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

    public function testIsExists()
    {
        $this->assertTrue(DB::isExists('persons', 'id', 1));
        $this->assertFalse(DB::isExists('persons', 'name', 'Samanta'));
    }
}