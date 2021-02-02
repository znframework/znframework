<?php namespace ZN\Shopping;

use Cart;

class DeleteItemTest extends \PHPUnit\Framework\TestCase
{
    public function testDelete()
    {
        $insert = Cart::insert
        ([
            'product'       => 'Banana',
            'price'         => '10',
            'quantity'      => 3,
            'serial-number' => '4432222345219'
        ]);

        Cart::delete('4432222345219');

        $this->assertEmpty(Cart::select('4432222345219'));
    }
}