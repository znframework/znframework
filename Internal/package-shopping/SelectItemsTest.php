<?php namespace ZN\Shopping;

use Cart;

class SelectItemsTest extends \PHPUnit\Framework\TestCase
{
    public function testSelectItems()
    {
        $data = 
        [
            'product'       => 'Banana',
            'price'         => '10',
            'quantity'      => 3,
            'serial-number' => '4432222345219'
        ];

        Cart::insert($data);

        $this->assertIsArray(Cart::selectItems());

        Cart::delete('4432222345219');
    }
}