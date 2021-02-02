<?php namespace ZN\Shopping;

use Cart;

class TotalItemsTest extends \PHPUnit\Framework\TestCase
{
    public function testTotalItems()
    {
        Cart::insert
        ([
            'product'       => 'Banana',
            'price'         => '10',
            'quantity'      => 3,
            'serial-number' => '4432222345219'
        ]);

        Cart::insert
        ([
            'product'       => 'Banana',
            'price'         => '10',
            'quantity'      => 3,
            'serial-number' => '4432222345219'
        ]);

        # 3 + 3
        $this->assertEquals(6, Cart::totalItems());

        Cart::delete('Banana');
    }
}