<?php namespace ZN\Database;

use DB;

class WhereClausesTest extends DatabaseExtends
{
    public function testWhereAnd()
    {
        $query = DB::string()->whereAnd('id', 1)->where('name', 'Susan')->persons();

        $this->assertSame("SELECT  *  FROM persons  WHERE id =  '1' AND  name =  'Susan' ", $query);
    }

    public function testWhereOr()
    {
        $query = DB::string()->whereOr('id', 1)->where('name', 'Susan')->persons();

        $this->assertSame("SELECT  *  FROM persons  WHERE id =  '1' OR  name =  'Susan' ", $query);
    }

    public function testWhereNot()
    {
        $query = DB::string()->whereNot('id', 1)->persons();

        $this->assertSame("SELECT  *  FROM persons  WHERE id !=  '1' ", $query);
    }

    public function testWhereLike()
    {
        $query = DB::string()->whereLike('name', 'us')->persons();

        $this->assertSame("SELECT  *  FROM persons  WHERE name like '%us%' ", $query);
    }

    public function testWhereStartLike()
    {
        $query = DB::string()->whereStartLike('name', 'us')->persons();

        $this->assertSame("SELECT  *  FROM persons  WHERE name like 'us%' ", $query);
    }

    public function testWhereBetween()
    {
        $query = DB::string()->whereBetween('id', 1, 5)->persons();

        $this->assertSame("SELECT  *  FROM persons  WHERE id between 1 AND 5 ", $query);
    }

    public function testWhereIn()
    {
        $query = DB::string()->whereIn('id', [1, 4, 6])->persons();

        $this->assertSame("SELECT  *  FROM persons  WHERE id in (1,4,6) ", $query);
    }

    public function testWhereNotIn()
    {
        $query = DB::string()->whereNotIn('id', [1, 4, 6])->persons();

        $this->assertSame("SELECT  *  FROM persons  WHERE id not in (1,4,6) ", $query);
    }

    public function testWhereJson()
    {
        $query = DB::string()->whereJson('content', 'example')->persons();

        $this->assertSame("SELECT  *  FROM persons  WHERE JSON_SEARCH(content, 'one', 'example') IS NOT NULL  ", $query);
    }

    public function testWhereNotJson()
    {
        $query = DB::string()->whereNotJson('content', 'example')->persons();

        $this->assertSame("SELECT  *  FROM persons  WHERE JSON_SEARCH(content, 'one', 'example') IS NULL  ", $query);
    }

    public function testWhereFulltext()
    {
        $query = DB::string()->whereFulltext('description', 'micheal')->persons();

        $this->assertSame("SELECT  *  FROM persons  WHERE MATCH(description) AGAINST('micheal')  ", $query);
    }

    public function testWhereEmpty()
    {
        $query = DB::string()->whereEmpty('name')->persons();

        $this->assertSame("SELECT  *  FROM persons  WHERE ( name =  \"\" or  name is null  ) ", $query);
    }

    public function testWhereNotEmpty()
    {
        $query = DB::string()->whereNotEmpty('name')->persons();

        $this->assertSame("SELECT  *  FROM persons  WHERE ( name!= \"\" and  name is not null  ) ", $query);
    }

    public function testWhereNull()
    {
        $query = DB::string()->whereNull('name')->persons();

        $this->assertSame("SELECT  *  FROM persons  WHERE name is null ", $query);
    }

    public function testWhereNotNull()
    {
        $query = DB::string()->whereNotNull('name')->persons();

        $this->assertSame("SELECT  *  FROM persons  WHERE name is not null ", $query);
    }

    public function testWhereColumnnameCondition()
    {
        $query = DB::string()->whereNameOr('Susan')->whereSurname('Orlando')->persons();

        $this->assertSame("SELECT  *  FROM persons  WHERE name =  'Susan' Or  surname =  'Orlando' ", $query);
    }
}