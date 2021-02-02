<?php namespace ZN\Shopping;

use Cart;

class InsertItemTest extends \PHPUnit\Framework\TestCase
{
    public function testInsert()
    {
        $insert = Cart::insert
        ([
            'product'       => 'Banana',
            'price'         => '10',
            'quantity'      => 3,
            'serial-number' => '4432222345219'
        ]);

        $this->assertTrue($insert);

        Cart::delete('4432222345219');
    }
}