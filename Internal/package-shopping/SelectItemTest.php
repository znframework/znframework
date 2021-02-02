<?php namespace ZN\Shopping;

use Cart;

class SelectItemTest extends \PHPUnit\Framework\TestCase
{
    public function testSelect()
    {
        $data = 
        [
            'product'       => 'Banana',
            'price'         => '10',
            'quantity'      => 3,
            'serial-number' => '4432222345219'
        ];

        Cart::insert($data);

        $this->assertEquals((object) $data, Cart::select('4432222345219'));

        Cart::delete('4432222345219');
    }

    public function testSelectWithArray()
    {
        $data = 
        [
            'product'       => 'Banana',
            'price'         => '10',
            'quantity'      => 3,
            'serial-number' => '4432222345219'
        ];

        Cart::insert($data);

        $this->assertEquals((object) $data, Cart::select(['product' => 'Banana']));

        Cart::delete('4432222345219');
    }
}