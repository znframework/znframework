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
    public function encode(string $string, string $salt = 'default') : string
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
    public function addSlashes(string $string, string $addDifferentChars = NULL) : string
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
    public function removeSlashes(string $string) : string
    {
        return stripslashes(stripcslashes($string));
    }
}
