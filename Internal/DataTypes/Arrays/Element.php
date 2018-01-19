<?php namespace ZN\DataTypes\Arrays;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\DataTypes\Exception\InvalidArgumentException;

class Element
{
    /**
     * Array Elements
     * 
     * @param array  $array
     * @param string $keyval = 'value' - options[value|key|values|keys]
     * 
     * @return mixed 
     */
    public static function use(Array $array, String $keyval = 'value')
    {
        switch( $keyval )
        {
            case 'value'  : return current($array);
            case 'key'    : return key($array);
            case 'values' : return array_values($array);
            case 'keys'   : return array_keys($array);
            default       : throw new InvalidArgumentException
            (
                '[Arrays::keyval()], 2.($keyval) parameter is invalid! [Available Options:] value, key, values, keys'
            );
        }
    }
}
