<?php namespace ZN\Shopping;

use Cart;

class TotalPricesTest extends \PHPUnit\Framework\TestCase
{
    public function testTotalPrices()
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

        # (3 x 10) + (3 x 10)
        $this->assertEquals(60, Cart::totalPrices());

        Cart::delete('Banana');
    }
}