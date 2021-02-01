<?php namespace ZN\Database;

use DB;
use Post;

class GrandModelTest extends \PHPUnit\Framework\TestCase
{
    public function testGrandCreate()
    {
        Persons::id([DB::int(11), DB::primaryKey(), DB::autoIncrement()])
               ->name([DB::varchar(255), DB::null()])
               ->address([DB::text()])
               ->create(DB::encoding());

        $this->assertSame("CREATE TABLE persons(id   INTEGER(11)  PRIMARY KEY  AUTOINCREMENT, name   VARCHAR(255)  NULL, address   TEXT) CHARACTER SET utf8 COLLATE utf8_general_ci ;", trim(Persons::stringQuery()));
    }

    public function testGrandInsert()
    {
        Persons::name('ZN Framework')->address('Istanbul')->insert();

        $this->assertSame("INSERT  INTO persons (name,address) VALUES ('ZN Framework','Istanbul')", trim(Persons::stringQuery()));
    }

    public function testGrandInsertMatch()
    {
        Persons::insert('post');

        $this->assertStringStartsWith("INSERT  INTO persons", trim(Persons::stringQuery()));
    }

    public function testGrandInsertDuplicateCheck()
    {
        Persons::duplicateCheck()->name('ZN Framework')->address('Istanbul')->insert();

        $this->assertSame("INSERT  INTO persons (name,address) VALUES ('ZN Framework','Istanbul')", trim(Persons::stringQuery()));
    }

    public function testGrandInsertDuplicateCheckUpdate()
    {
        Persons::duplicateCheck()->name('ZN Framework')->address('Istanbul')->insert();

        $this->assertSame("INSERT  INTO persons (name,address) VALUES ('ZN Framework','Istanbul')", trim(Persons::stringQuery()));
    }

    public function testGrandInsertId()
    {
        Persons::name('ZN Framework')->phone('1234')->insert();

        $this->assertIsInt(Persons::insertId());
    }

    public function testGrandTotalRows()
    {
        Persons::limit(1)->result();

        $this->assertIsInt(Persons::totalRows());
    }

    public function testGrandResultWithSelect()
    {
        Persons::select('name', 'surname')->result();

        $this->assertSame("SELECT  name,surname  FROM persons", trim(Persons::stringQuery()));
    }

    public function testGrandUpdateColumnName()
    {
        Persons::updateId
        ([
            'name'    => 'ZERONEED',
            'address' => 'Istanbul/Turkey'
        ], 1);

        $this->assertSame("UPDATE persons SET name='ZERONEED',address='Istanbul/Turkey' WHERE Id =  '1'", trim(Persons::stringQuery()));
    }

    public function testGrandUpdate()
    {
        Persons::where('id', 5)->update
        ([
            'name'    => 'ZERONEED',
            'address' => 'Istanbul/Turkey'
        ]);

        $this->assertSame("UPDATE persons SET name='ZERONEED',address='Istanbul/Turkey' WHERE id =  '5'", trim(Persons::stringQuery()));
    }

    public function testGrandDeleteColumnName()
    {
        Persons::deleteId(1);

        $this->assertSame("DELETE  FROM persons WHERE Id =  '1'", trim(Persons::stringQuery()));
    }

    public function testGrandDelete()
    {
        Persons::where('id', 5)->delete();

        $this->assertSame("DELETE  FROM persons WHERE id =  '5'", trim(Persons::stringQuery()));
    }

    public function testGrandRowColumnName()
    {
        Persons::rowId(1);

        $this->assertSame("SELECT  *  FROM persons  WHERE Id =  '1'", trim(Persons::stringQuery()));
    }

    public function testGrandResultColumnName()
    {
        Persons::resultId(1);

        $this->assertSame("SELECT  *  FROM persons  WHERE Id =  '1'", trim(Persons::stringQuery()));
    }

    public function testGrandResult()
    {
        Persons::result();

        $this->assertSame("SELECT  *  FROM persons", trim(Persons::stringQuery()));
    }

    public function testGrandPagination()
    {
        Persons::limit(NULL, 5)->result();

        $this->assertIsString(Persons::pagination());
    }

    public function testGrandAddColumn()
    {
        Persons::address([DB::text()])->date([DB::datetime()])->add();

        $this->assertSame("ALTER TABLE persons ADD address  TEXT ,date  DATETIME ;", trim(Persons::stringQuery()));
    }

    public function testGrandModifyColumn()
    {
        Persons::address([DB::text()])->date([DB::datetime()])->modify();

        # SQLite3 unsupported
        $this->assertSame("", trim(Persons::stringQuery()));
    }

    public function testGrandRenameColumn()
    {
        Persons::address(['address2', DB::text()])->rename();

        # SQLite3 unsupported
        $this->assertSame("", trim(Persons::stringQuery()));
    }

    public function testGrandDropColumn()
    {
        Persons::address(['address2', DB::text()])->drop();

        # SQLite3 unsupported
        $this->assertSame("", trim(Persons::stringQuery()));
    }

    public function testGrandGet()
    {
        $table = Persons::get();

        # SQLite3 unsupported
        $this->assertSame("SELECT  *  FROM persons", trim($table->stringQuery()));
    }
}