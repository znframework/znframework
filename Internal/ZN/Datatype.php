<?php namespace ZN;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Datatype
{   
    /**
     * Divide
     * 
     * @param string $str       = NULL
     * @param string $separator = '|'
     * @param string $index     = '0'
     */
    public static function divide(String $str = NULL, String $separator = '|', String $index = '0')
    {
        $arrayEx = explode($separator, $str);

        if( $index === 'all' )
        {
            return $arrayEx;
        }

        switch( true )
        {
            case $index < 0        : $ind = (count($arrayEx) + ($index)); break;
            case $index === 'last' : $ind = (count($arrayEx) - 1);        break;
            case $index === 'first': $ind = 0;                            break;
            default                : $ind = $index;
        }

        return $arrayEx[$ind] ?? false;
    }

    /**
     * Split Upper Case
     * 
     * @param string $string
     * 
     * @return array
     */
    public static function splitUpperCase(String $string) : Array
    {
        return preg_split('/(?=[A-Z])/', $string, -1, PREG_SPLIT_NO_EMPTY);
    }
}