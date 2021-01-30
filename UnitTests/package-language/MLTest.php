<?php namespace ZN\Language;

use ML;

class MLTest extends \PHPUnit\Framework\TestCase
{
    public function testInsert()
    {
        ML::insert('en', ['pencil' => 'Pencil', 'desk' => 'Desk', 'order' => 'Order']);
        
        $this->assertSame('Pencil', ML::select('pencil'));
        $this->assertSame('Desk', ML::select('desk'));
    }

    public function testSelect()
    {
        $this->assertSame('Desk', ML::select('desk'));
    }

    public function testSelectAll()
    {
        $this->assertSame('Desk', ML::selectAll('en')['desk']);
    }

    public function testKeys()
    {
        $keys = ML::keys();

        $this->assertSame('Pencil', $keys->pencil);
    }

    public function testLangs()
    {
        $this->assertIsArray(ML::langs());
    }

    public function testUpdate()
    {
        ML::update('en', 'order', 'Orderx');

        $this->assertSame('Orderx', ML::select('order'));
    }

    public function testDelete()
    {
        ML::delete('en', 'order');

        # If not, it returns itself.
        $this->assertSame('order', ML::select('order'));
    }

    public function testDeleteAll()
    {
        ML::deleteAll();

        # If not, it returns itself.
        $this->assertSame('pencil', ML::select('pencil'));
    }

    public function testLang()
    {
        ML::insert('en', 'pencil', 'Pencil');
        ML::insert('tr', 'pencil', 'Kalem');
        
        $this->assertSame('Pencil', ML::select('pencil'));

        ML::lang('tr');

        $this->assertSame('Kalem', ML::select('pencil'));
    }
}