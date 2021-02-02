<?php namespace ZN\Shopping;

use Cart;

class DeleteItemsTest extends \PHPUnit\Framework\TestCase
{
    public function testDeleteItems()
    {
        $insert = Cart::insert
        ([
            'product'       => 'Banana',
            'price'         => '10',
            'quantity'      => 3,
            'serial-number' => '4432222345219'
        ]);

        Cart::deleteItems();

        $this->assertEmpty(Cart::selectItems());
    }
}