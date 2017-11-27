<?php namespace ZN\DataTypes\Strings;

class Split
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
    // Split Upper Case -> 5.2.0
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    //
    //--------------------------------------------------------------------------------------------------------
    public static function upperCase(String $string) : Array
    {
        return preg_split('/(?=[A-Z])/', $string, -1, PREG_SPLIT_NO_EMPTY);
    }

    //--------------------------------------------------------------------------------------------------------
    // Apportion
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $string
    // @param numeric $length
    // @param string  $end
    //
    //--------------------------------------------------------------------------------------------------------
    public static function apportion(String $string, Int $length = 76, String $end = "\r\n") : String
    {
        $arrayChunk = array_chunk(preg_split("//u", $string, -1, PREG_SPLIT_NO_EMPTY), $length);

        $string = "";

        foreach( $arrayChunk as $chunk )
        {
            $string .= implode("", $chunk) . $end;
        }

        return $string;
    }

    //--------------------------------------------------------------------------------------------------------
    // Divide
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $string
    // @param string  $seperator
    // @param numeric $index
    //
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
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
}
