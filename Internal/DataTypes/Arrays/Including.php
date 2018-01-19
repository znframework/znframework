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

use ZN\DataTypes\Exception\LogicException;

class Including
{
    /**
     * Include Element
     * 
     * @param array $array
     * @param array $including
     * 
     * @return array
     */
    public static function use(Array $array, Array $including) : Array
    {
        $newArray = [];

        if( count($including) > count($array) )
        {
            throw new LogicException
            (
                'DataTypes',
                'array:notExceedLength',
                ['%' => '2.($including)', '#' => '1.($array)']
            );
        }

        foreach( $array as $key => $val )
        {
            if( in_array($val, $including) || in_array(Excluding::keyControl($key), $including) )
            {
                $newArray[$key] = $val;
            }
        }

        return $newArray;
    }
}
