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

class Delete extends CartExtends
{
    /**
     * Delete item
     * 
     * @param mixed $code
     * 
     * @return bool
     */
    public function item($code) : Bool
    {
        Properties::$items = (array) $this->driver->select($this->key);

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

        return $this->driver->insert($this->key, Properties::$items);
    }

    /**
     * Delete all items
     * 
     * @param void
     * 
     * @return bool
     */
    public function items() : Bool
    {
        return $this->driver->delete($this->key);
    }
}
