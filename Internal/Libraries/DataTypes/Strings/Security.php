<?php namespace ZN\DataTypes\Strings;

class Security implements SecurityInterface
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
    // Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param string $salt
    //
    //--------------------------------------------------------------------------------------------------------
    public function encode(String $string, String $salt = 'default') : String
    {
        return crypt($string, $salt);
    }

    //--------------------------------------------------------------------------------------------------------
    // Add Slashes
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param string $addDifferentChars
    //
    //--------------------------------------------------------------------------------------------------------
    public function addSlashes(String $string, String $addDifferentChars = NULL) : String
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
    public function removeSlashes(String $string) : String
    {
        return stripslashes(stripcslashes($string));
    }
}
