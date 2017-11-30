<?php namespace ZN\DataTypes\Strings;

class Element
{
    //--------------------------------------------------------------------------------------------------------
    // Element -> 5.4.5
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------
    
    //--------------------------------------------------------------------------------------------------------
    // Remove First
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param string $separator = '/'
    // @param int    $index     = 0
    //
    //--------------------------------------------------------------------------------------------------------
    public static function removeFirst(String $str, String $separator = '/', Int $index = 0) : String
    {
        return self::remove($str, $separator, abs($index));
    }

    //--------------------------------------------------------------------------------------------------------
    // Remove First
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param string $separator = '/'
    // @param int    $index     = 0
    //
    //--------------------------------------------------------------------------------------------------------
    public static function removeLast(String $str, String $separator = '/', Int $index = 0) : String
    {
        return self::remove($str, $separator, -abs($index));
    }

    //--------------------------------------------------------------------------------------------------------
    // Remove Section -> 5.4.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param string $separator = '/'
    // @param int    $index     = 0
    //
    //--------------------------------------------------------------------------------------------------------
    public static function remove(String $str, String $separator = '/', Int $index = 0) : String
    {
        $strEx = explode($separator, $str);

        if( ($countStr = count($strEx)) === 1 ) return $str;

        $count = abs($index);

        if( $countStr < $count ) $count = $countStr;
   
        if( $count > 0 ) for( $start = 1; $start <= $count; $start++ )
        {
           ($index < 0 ? 'array_pop' : 'array_shift')($strEx);
        }

        return implode($separator, $strEx);
    }
}
