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
     * Case Array
     * 
     * @param array  $array
     * @param string $type   - options[lower|upper|title]
     * @param string $keyval - options[all|key|value]
     * 
     * @return array
     */
    public static function caseArray(Array $array, String $type = 'lower', String $keyval = 'all') : Array
    {
        $callback = function($data) use($type)
        {
            return mb_convert_case($data, Helper::toConstant($type, 'MB_CASE_'));
        };
   
        $arrayVals = array_values($array); $arrayKeys = array_keys($array);
      
        switch( $keyval )
        {
            case 'key'  : $arrayKeys = array_map($callback, $arrayKeys); break;
            case 'value': $arrayVals = array_map($callback, $arrayVals); break;
            case 'all'  :
            default     : $arrayKeys = array_map($callback, $arrayKeys);
                          $arrayVals = array_map($callback, $arrayVals);
        }
   
        return array_combine($arrayKeys, $arrayVals);
    }

    /**
     * Multiple Key
     * 
     * @param array  $array
     * @param string $keySplit = '|'
     * 
     * @return array
     */
    public static function multikey(Array $array, String $keySplit = '|') : Array
    {
        $newArray = [];

        foreach( $array as $k => $v )
        {
            $keys = explode($keySplit, $k);

            foreach( $keys as $val )
            {
                $newArray[$val] = $v;
            }
        }

        return $newArray;
    }

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