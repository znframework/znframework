<?php namespace ZN\IndividualStructures\Cart;

class Update extends CartExtends
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
    // Update Item
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $code
    // @param array $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function item($code, Array $data) : Bool
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
                if(isset($row[key($code)]) && $row[key($code)] == current($code))
                {
                    $code = $row[key($code)];
                }
            }

            $key = array_search($code,$row);

            if( ! empty($key) )
            {
                array_splice(Properties::$items, $i, 1);

                if( count($data) !== count($row) )
                {
                    foreach( $data as $k => $v )
                    {
                        $row[$k] = $v;
                    }

                    array_push(Properties::$items, $row);
                }
                else
                {
                    array_push(Properties::$items, $data);
                }
            }

            $i++;
        }

        return $this->driver->insert(md5('SystemCartData'), Properties::$items);
    }
}
