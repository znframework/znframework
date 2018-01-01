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

class Insert extends CartExtends
{
    //--------------------------------------------------------------------------------------------------------
    // Insert Item
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $product
    //
    //--------------------------------------------------------------------------------------------------------
    public function item(Array $product) : Bool
    {
        // Ürünün adet parametresinin belirtilmemesi durumunda 1 olarak kabul edilmesi istenmiştir.
        if( ! isset($product['quantity']) )
        {
            $product['quantity'] = 1;
        }

        // Sepettin daha önce oluşturulup oluşturulmadığına göre işlemler gerçekleştiriliyor.
        if( $sessionCart = $this->driver->select(md5('SystemCartData')) )
        {
            Properties::$items = $sessionCart;
        }

        array_push(Properties::$items, $product);

        $this->driver->insert(md5('SystemCartData'), Properties::$items);

        Properties::$items = $this->driver->select(md5('SystemCartData'));

        return true;
    }
}
