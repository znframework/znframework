<?php namespace ZN\DataTypes\Strings;

class Search implements SearchInterface
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
    public function use(String $str, String $needle, String $type = 'string', Bool $case = true) : String
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
    public function position(String $str, String $needle, Bool $case = true) : String
    {
        return $this->use($str, $needle, __FUNCTION__, $case);
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
    public function string(String $str, String $needle, Bool $case = true) : String
    {
        return $this->use($str, $needle, __FUNCTION__, $case);
    }
}
