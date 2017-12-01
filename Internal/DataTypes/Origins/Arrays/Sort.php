<?php namespace ZN\DataTypes\Arrays;

use ZN\Helpers\Converter;

class Sort
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
    // Order
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $type :desc, asc...
    // @param string $flags:regular
    //
    //--------------------------------------------------------------------------------------------------------
    public static function order(Array $array, String $type = NULL, String $flags = 'regular') : Array
    {
        $flags = Converter::toConstant($flags, 'SORT_');

        switch($type)
        {
            case 'desc'         : arsort($array, $flags);   break;
            case 'asc'          : asort($array, $flags);    break;
            case 'asckey'       : ksort($array, $flags);    break;
            case 'desckey'      : krsort($array, $flags);   break;
            case 'insens'       : natcasesort($array);      break;
            case 'natural'      : natsort($array);          break;
            case 'reverse'      : rsort($array, $flags);    break;
            case 'userassoc'    : uasort($array, $flags);   break;
            case 'userkey'      : uksort($array, $flags);   break;
            case 'user'         : usort($array, $flags);    break;
            case 'random'       : shuffle($array);          break;
            default             : sort($array, $flags);
        }

        return $array;
    }

    //--------------------------------------------------------------------------------------------------------
    // Sort
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $flags:regular
    //
    //--------------------------------------------------------------------------------------------------------
    public static function normal(Array $array, String $flag = 'regular') : Array
    {
        return self::order($array, 'sort', $flag);
    }

    //--------------------------------------------------------------------------------------------------------
    // Descending
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $flags:regular
    //
    //--------------------------------------------------------------------------------------------------------
    public static function descending(Array $array, String $flag = 'regular') : Array
    {
        return self::order($array, 'desc', $flag);
    }

    //--------------------------------------------------------------------------------------------------------
    // Ascending
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $flags:regular
    //
    //--------------------------------------------------------------------------------------------------------
    public static function ascending(Array $array, String $flag = 'regular') : Array
    {
        return self::order($array, 'asc', $flag);
    }

    //--------------------------------------------------------------------------------------------------------
    // Ascending Key
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $flags:regular
    //
    //--------------------------------------------------------------------------------------------------------
    public static function ascendingKey(Array $array, String $flag = 'regular') : Array
    {
        return self::order($array, 'asckey', $flag);
    }

    //--------------------------------------------------------------------------------------------------------
    // Descending Key
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $flags:regular
    //
    //--------------------------------------------------------------------------------------------------------
    public static function descendingKey(Array $array, String $flag = 'regular') : Array
    {
        return self::order($array, 'desckey', $flag);
    }

    //--------------------------------------------------------------------------------------------------------
    // User Assoc Sort
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $flags:regular
    //
    //--------------------------------------------------------------------------------------------------------
    public static function userAssoc(Array $array, String $flag = 'regular') : Array
    {
        return self::order($array, 'userassoc', $flag);
    }

    //--------------------------------------------------------------------------------------------------------
    // User Key Sort
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $flags:regular
    //
    //--------------------------------------------------------------------------------------------------------
    public static function userKey(Array $array, String $flag = 'regular') : Array
    {
        return self::order($array, 'userkey', $flag);
    }

    //--------------------------------------------------------------------------------------------------------
    // User Sort
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $flags:regular
    //
    //--------------------------------------------------------------------------------------------------------
    public static function user(Array $array, String $flag = 'regular') : Array
    {
        return self::order($array, 'user', $flag);
    }

    //--------------------------------------------------------------------------------------------------------
    // insensitive Sort
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    //
    //--------------------------------------------------------------------------------------------------------
    public static function insensitive(Array $array) : Array
    {
        return self::order($array, 'natcasesort');
    }

    //--------------------------------------------------------------------------------------------------------
    // Natural Sort
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    //
    //--------------------------------------------------------------------------------------------------------
    public static function natural(Array $array) : Array
    {
        return self::order($array, 'natsort');
    }

    //--------------------------------------------------------------------------------------------------------
    // Shuffle
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    //
    //--------------------------------------------------------------------------------------------------------
    public static function shuffle(Array $array) : Array
    {
        return self::order($array, 'random');
    }
}
