<?php namespace ZN\IndividualStructures\Cart;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Total extends CartExtends
{
    //--------------------------------------------------------------------------------------------------------
    // Total Items
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function items() : Int
    {
        $totalItems  = 0;

        if( $sessionCart = $this->driver->select(md5('SystemCartData')) )
        {
            Properties::$items = $sessionCart;

            if( ! empty(Properties::$items) ) foreach( Properties::$items as $item )
            {
                $totalItems += $item['quantity'];
            }

            return $totalItems;
        }
        else
        {
            return $totalItems;
        }
    }


    //--------------------------------------------------------------------------------------------------------
    // Total Prices
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $code
    //
    //--------------------------------------------------------------------------------------------------------
    public function prices() : Int
    {
        Properties::$items = (array) $this->driver->select(md5('SystemCartData'));

        if( empty(Properties::$items) )
        {
            return 0;
        }

        $total = 0;

        foreach( Properties::$items as $values )
        {
            $quantity  = isset($values['quantity'])
                       ? $values['quantity']
                       : 1;

            $price = isset($values['price'])
                   ? $values['price']
                   : 0;

            $total += $price * $quantity;
        }

        return $total;
    }
}
