<?php namespace ZN\DataTypes\Strings;

class Security
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
    // Add Slashes
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param string $addDifferentChars
    //
    //--------------------------------------------------------------------------------------------------------
    public static function addSlashes(String $string, String $addDifferentChars = NULL) : String
    {
        $return = addslashes($string);

        if( ! empty($addDifferentChars) )
        {
            $return = addcslashes($return, $addDifferentChars);
        }

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Remove Slashes
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public static function removeSlashes(String $string) : String
    {
        return stripslashes(stripcslashes($string));
    }
}
