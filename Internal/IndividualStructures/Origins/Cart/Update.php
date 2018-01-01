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

class Update extends CartExtends
{
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
