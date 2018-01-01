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

class Select extends CartExtends
{
    //--------------------------------------------------------------------------------------------------------
    // Select Items
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function items() : Array
    {
        if( $sessionCart = $this->driver->select(md5('SystemCartData')) )
        {
            return Properties::$items = $sessionCart;
        }
        else
        {
            return [];
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Select Item
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $code
    //
    //--------------------------------------------------------------------------------------------------------
    public function item($code)
    {
        Properties::$items = (array) $this->driver->select(md5('SystemCartData'));

        if( empty(Properties::$items) )
        {
            return false;
        }

        foreach( Properties::$items as $row )
        {
            if( ! is_array($code) )
            {
                $key = array_search($code, $row);
            }
            else
            {
                if( isset($row[key($code)]) && $row[key($code)] == current($code) )
                {
                    $key = $row;
                }
            }

            if( ! empty($key) )
            {
                return (object) $row;
            }
        }
    }
}
