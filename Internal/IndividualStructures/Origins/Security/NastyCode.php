<?php namespace ZN\IndividualStructures\Security;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class NastyCode
{
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
