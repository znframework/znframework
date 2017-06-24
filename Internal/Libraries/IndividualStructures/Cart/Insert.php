<?php namespace ZN\IndividualStructures\Cart;

class Insert extends CartExtends
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

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
