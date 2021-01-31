<?php namespace ZN\Database;

use DB;
use DBForge;

class TalkingQueriesTest extends DatabaseExtends
{
    public function testResult()
    {
        $result = DB::personsResult();

        $this->assertIsArray($result);
    }

    public function testRow()
    {
        $result = DB::personsRow();

        $this->assertIsObject($result);
    }

    public function testRowWhere()
    {
        $result = DB::personsRowName('Susan');

        $this->assertSame('Susan', $result->name);
    }

    public function testRowValue()
    {
        $result = DB::whereName('Susan')->personsRowName();

        $this->assertSame('Susan', $result);
    }

    public function testJoin()
    {
        DB::leftJoinAccoutsIdCommentsUser_id()
            ->rightJoinCommentsUser_idTopicUser_id('!=')
            ->commentsResult();

        $this->assertSame('SELECT  *  FROM comments  LEFT JOIN accouts ON accouts.id = comments.user_id   RIGHT JOIN comments ON comments.user_id != topic.user_id', trim(DB::stringQuery()));
    }

    public function testGroupBy()
    {
        DB::groupByCreate_date()->productsResult();

        $this->assertSame('SELECT  *  FROM products  GROUP BY create_date', trim(DB::stringQuery()));
    }

    public function testOrderBy()
    {
        DB::orderByCreate_dateAsc()->productsResult();

        $this->assertSame('SELECT  *  FROM products  ORDER BY create_date Asc', trim(DB::stringQuery()));
    }

    public function testInsert()
    {
        DB::blogInsert(['name' => 'New Blog', 'content' => 'New Blog Content']);

        $this->assertSame("INSERT  INTO blog (name,content) VALUES ('New Blog','New Blog Content')", trim(DB::stringQuery()));
    }

    public function testUpdate()
    {
        DB::whereId(1)->blogUpdate(['name' => 'New Blog 2']);

        $this->assertSame("UPDATE blog SET name='New Blog 2' WHERE id =  '1'", trim(DB::stringQuery()));
    }

    public function testUpdateWhere()
    {
        DB::blogUpdateId(['name' => 'New Blog 2'], 1);

        $this->assertSame("UPDATE blog SET name='New Blog 2' WHERE Id =  '1'", trim(DB::stringQuery()));
    }

    public function testDelete()
    {
        DB::whereName('New Blog 2')->blogDelete();

        $this->assertSame("DELETE  FROM blog WHERE name =  'New Blog 2'", trim(DB::stringQuery()));
    }

    public function testDeleteWhere()
    {
        DB::blogDeleteName('New Blog 2');

        $this->assertSame("DELETE  FROM blog WHERE Name =  'New Blog 2'", trim(DB::stringQuery()));
    }

    public function testCreateTable()
    {
        DBForge::accountsCreate(['id' => [DB::int(11), DB::autoIncrement(), DB::primaryKey()]]);

        $this->assertSame("CREATE TABLE accounts(id   INTEGER(11)  AUTOINCREMENT  PRIMARY KEY)", trim(DBForge::stringQuery()));
    }

    public function testDropTable()
    {
        DBForge::accountsDrop();

        $this->assertSame("DROP TABLE accounts", trim(DBForge::stringQuery()));
    }

    public function testTruncateTable()
    {
        DBForge::accountsTruncate();

        $this->assertSame("DELETE FROM accounts", trim(DBForge::stringQuery()));
    }

    public function testRenameTable()
    {
        DBForge::accountsRename('new_accounts');

        $this->assertSame("ALTER TABLE accounts RENAME TO new_accounts", trim(DBForge::stringQuery()));
    }
}