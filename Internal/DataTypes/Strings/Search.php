<?php namespace ZN\DataTypes\Strings;

class Search
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
    // Search
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param string $needle
    // @param string $type, Options: string, position
    // @param string $case
    //
    //--------------------------------------------------------------------------------------------------------
    public static function use(String $str, String $needle, String $type = 'string', Bool $case = true)
    {
        if( $type === 'string' )
        {
            if( $case === true )
            {
                $function = 'mb_strstr';
            }
            else
            {
                $function = 'mb_stristr';
            }

            return $function($str, $needle);
        }

        if( $type === 'position' )
        {
            if( $case === true )
            {
                $function = 'mb_strpos';
            }
            else
            {
                $function = 'mb_stripos';
            }

            return $function($str, $needle);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Position
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param string $needle
    // @param string $case
    //
    //--------------------------------------------------------------------------------------------------------
    public static function position(String $str, String $needle, Bool $case = true)
    {
        return self::use($str, $needle, __FUNCTION__, $case);
    }

    //--------------------------------------------------------------------------------------------------------
    // String
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param string $needle
    // @param string $case
    //
    //--------------------------------------------------------------------------------------------------------
    public static function string(String $str, String $needle, Bool $case = true) : String
    {
        return self::use($str, $needle, __FUNCTION__, $case);
    }
}
