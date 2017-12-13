<?php namespace ZN\IndividualStructures\Security;

class NastyCode
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
    // Nc Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    // @param mixed  $badWords
    // @param mixed  $changeChar
    //
    //--------------------------------------------------------------------------------------------------------
    public static function encode(String $string, $badWords = NULL, $changeChar = '[badchars]') : String
    {
        if( empty($badWords) )
        {
            $secnc      = Properties::$ncEncode;
            $badWords   = $secnc['badChars'];
            $changeChar = $secnc['changeBadChars'];
        }

        if( ! is_array($badWords) )
        {
            return $string = \Regex::replace($badWords, $changeChar, $string, 'xi');
        }

        $ch = '';
        $i  = 0;

        foreach( $badWords as $value )
        {
            if( ! is_array($changeChar) )
            {
                $ch = $changeChar;
            }
            else
            {
                if( isset($changeChar[$i]) )
                {
                    $ch = $changeChar[$i];
                    $i++;
                }
            }

            $string = \Regex::replace($value, $ch, $string, 'xi');
        }

        return $string;
    }
}
