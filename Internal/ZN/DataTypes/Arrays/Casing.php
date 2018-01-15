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

class Casing
{
    //--------------------------------------------------------------------------------------------------------
    // Casing
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $type  : lower, upper, title
    // @param string $keyval: all, key, value
    //
    //--------------------------------------------------------------------------------------------------------
    public static function use(Array $array, String $type = 'lower', String $keyval = 'all') : Array
    {
        switch( $type )
        {
            case 'lower': $caseType = 'ZN\DataTypes\Strings\Casing::lower'; break;
            case 'upper': $caseType = 'ZN\DataTypes\Strings\Casing::upper'; break;
            case 'title': $caseType = 'ZN\DataTypes\Strings\Casing::title'; break;
        }
   
        $arrayVals = array_values($array);
        $arrayKeys = array_keys  ($array);
      
        switch( $keyval )
        {
            case 'key'  : $arrayKeys = array_map($caseType, $arrayKeys); break;
            case 'value': $arrayVals = array_map($caseType, $arrayVals); break;
            case 'all'  :
            default     : $arrayKeys = array_map($caseType, $arrayKeys);
                          $arrayVals = array_map($caseType, $arrayVals);
        }
   
        return array_combine($arrayKeys, $arrayVals);
    }

    //--------------------------------------------------------------------------------------------------------
    // Lower Keys
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    //
    //--------------------------------------------------------------------------------------------------------
    public static function lowerKeys(Array $array) : Array
    {
        return array_change_key_case($array);
    }

    //--------------------------------------------------------------------------------------------------------
    // Title Keys
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    //
    //--------------------------------------------------------------------------------------------------------
    public static function titleKeys(Array $array) : Array
    {
        return self::use($array, 'title', 'key');
    }

    //--------------------------------------------------------------------------------------------------------
    // Upper Keys
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    //
    //--------------------------------------------------------------------------------------------------------
    public static function upperKeys(Array $array) : Array
    {
        return array_change_key_case($array, CASE_UPPER);
    }

    //--------------------------------------------------------------------------------------------------------
    // Lower Values
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    //
    //--------------------------------------------------------------------------------------------------------
    public static function lowerValues(Array $array) : Array
    {
        return self::use($array, 'lower', 'value');
    }

    //--------------------------------------------------------------------------------------------------------
    // Title Values
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    //
    //--------------------------------------------------------------------------------------------------------
    public static function titleValues(Array $array) : Array
    {
        return self::use($array, 'title', 'value');
    }

    //--------------------------------------------------------------------------------------------------------
    // Upper Values
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    //
    //--------------------------------------------------------------------------------------------------------
    public static function upperValues(Array $array) : Array
    {
        return self::use($array, 'upper', 'value');
    }

    //--------------------------------------------------------------------------------------------------------
    // Lower
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    //
    //--------------------------------------------------------------------------------------------------------
    public static function lower(Array $array) : Array
    {
        return self::use($array, 'lower', 'all');
    }

    //--------------------------------------------------------------------------------------------------------
    // Title
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    //
    //--------------------------------------------------------------------------------------------------------
    public static function title(Array $array) : Array
    {
        return self::use($array, 'title', 'all');
    }

    //--------------------------------------------------------------------------------------------------------
    // Upper
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    //
    //--------------------------------------------------------------------------------------------------------
    public static function upper(Array $array) : Array
    {
        return self::use($array, 'upper', 'all');
    }
}
