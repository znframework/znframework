<?php namespace ZN\Shopping;
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
    /**
     * Total items
     * 
     * @param void
     * 
     * @return int
     */
    public function items() : Int
    {
        $totalItems  = 0;

        if( $sessionCart = $this->driver->select($this->key) )
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


    /**
     * Total prices
     * 
     * @param void
     * 
     * @return int
     */
    public function prices() : Int
    {
        Properties::$items = (array) $this->driver->select($this->key);

        if( empty(Properties::$items) )
        {
            return 0;
        }

        $total = 0;

        foreach( Properties::$items as $values )
        {
            $quantity = (int)   ($values['quantity'] ?? 1);
            $price    = (float) ($values['price']    ?? 0);

            $total += $price * $quantity;
        }

        return $total;
    }
}
