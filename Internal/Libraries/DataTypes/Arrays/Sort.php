<?php namespace ZN\DataTypes\Arrays;

use Converter;

class Sort implements SortInterface
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
    public function order(array $array, string $type = NULL, string $flags = 'regular') : array
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
    public function normal(array $array, string $flag = 'regular') : array
    {
        return $this->order($array, 'sort', $flag);
    }

    //--------------------------------------------------------------------------------------------------------
    // Descending
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $flags:regular
    //
    //--------------------------------------------------------------------------------------------------------
    public function descending(array $array, string $flag = 'regular') : array
    {
        return $this->order($array, 'desc', $flag);
    }

    //--------------------------------------------------------------------------------------------------------
    // Ascending
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $flags:regular
    //
    //--------------------------------------------------------------------------------------------------------
    public function ascending(array $array, string $flag = 'regular') : array
    {
        return $this->order($array, 'asc', $flag);
    }

    //--------------------------------------------------------------------------------------------------------
    // Ascending Key
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $flags:regular
    //
    //--------------------------------------------------------------------------------------------------------
    public function ascendingKey(array $array, string $flag = 'regular') : array
    {
        return $this->order($array, 'asckey', $flag);
    }

    //--------------------------------------------------------------------------------------------------------
    // Descending Key
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $flags:regular
    //
    //--------------------------------------------------------------------------------------------------------
    public function descendingKey(array $array, string $flag = 'regular') : array
    {
        return $this->order($array, 'desckey', $flag);
    }

    //--------------------------------------------------------------------------------------------------------
    // User Assoc Sort
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $flags:regular
    //
    //--------------------------------------------------------------------------------------------------------
    public function userAssoc(array $array, string $flag = 'regular') : array
    {
        return $this->order($array, 'userassoc', $flag);
    }

    //--------------------------------------------------------------------------------------------------------
    // User Key Sort
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $flags:regular
    //
    //--------------------------------------------------------------------------------------------------------
    public function userKey(array $array, string $flag = 'regular') : array
    {
        return $this->order($array, 'userkey', $flag);
    }

    //--------------------------------------------------------------------------------------------------------
    // User Sort
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $flags:regular
    //
    //--------------------------------------------------------------------------------------------------------
    public function user(array $array, string $flag = 'regular') : array
    {
        return $this->order($array, 'user', $flag);
    }

    //--------------------------------------------------------------------------------------------------------
    // insensitive Sort
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    //
    //--------------------------------------------------------------------------------------------------------
    public function insensitive(array $array) : array
    {
        return $this->order($array, 'natcasesort');
    }

    //--------------------------------------------------------------------------------------------------------
    // Natural Sort
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    //
    //--------------------------------------------------------------------------------------------------------
    public function natural(array $array) : array
    {
        return $this->order($array, 'natsort');
    }

    //--------------------------------------------------------------------------------------------------------
    // Shuffle
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    //
    //--------------------------------------------------------------------------------------------------------
    public function shuffle(array $array) : array
    {
        return $this->order($array, 'random');
    }
}
