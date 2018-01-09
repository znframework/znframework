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

class Insert extends CartExtends
{
    /**
     * Insert item
     * 
     * @param array $product
     * 
     * @return bool
     */
    public function item(Array $product) : Bool
    {
        if( ! isset($product['quantity']) )
        {
            $product['quantity'] = 1;
        }
        
        if( $sessionCart = $this->driver->select($this->key) )
        {
            Properties::$items = $sessionCart;
        }

        array_push(Properties::$items, $product);

        $this->driver->insert($this->key, Properties::$items);

        Properties::$items = $this->driver->select($this->key);

        return true;
    }
}
