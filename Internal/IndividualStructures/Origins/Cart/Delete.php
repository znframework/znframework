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

class Delete extends CartExtends
{
    //--------------------------------------------------------------------------------------------------------
    // Delete Item
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $code
    //
    //--------------------------------------------------------------------------------------------------------
    public function item($code) : Bool
    {
        Properties::$items = (array) $this->driver->select(md5('SystemCartData'));

        if( empty(Properties::$items) )
        {
            return false;
        }

        $i = 0;

        foreach( Properties::$items as $row )
        {
            if( is_array($code) )
            {
                if( isset($row[key($code)]) && $row[key($code)] == current($code) )
                {
                    $code = $row[key($code)];
                }
            }

            $key = array_search($code, $row);

            if( ! empty($key) )
            {
                array_splice(Properties::$items, $i--, 1);
            }

            $i++;
        }

        return $this->driver->insert(md5('SystemCartData'), Properties::$items);
    }

    //--------------------------------------------------------------------------------------------------------
    // Delete Items
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function items() : Bool
    {
        return $this->driver->delete(md5('SystemCartData'));
    }
}
