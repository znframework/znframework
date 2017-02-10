<?php namespace ZN\IndividualStructures\Cart;

class Delete extends CartExtends implements DeleteInterface
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
    // Delete Item
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $code
    //
    //--------------------------------------------------------------------------------------------------------
    public function item($code) : Bool
    {
        Properties::$items = $this->driver->select(md5('SystemCartData')) ?? [];

        if( empty(Properties::$items) )
        {
            return false;
        }

        $i=0;

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
