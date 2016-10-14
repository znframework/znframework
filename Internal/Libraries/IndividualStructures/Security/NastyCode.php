<?php namespace ZN\IndividualStructures\Security;

use Regex;

class NastyCode extends SecurityExtends implements NastyCodeInterface
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
    public function encode(String $string, $badWords = NULL, $changeChar = '[badchars]') : String
    {
        // 2. Parametre boş ise varsayılan olarak Config/Security.php dosya ayarlarını kullan.
        if( empty($badWords) )
        {
            $secnc      = INDIVIDUALSTRUCTURES_SECURITY_CONFIG['ncEncode'];
            $badWords   = $secnc['badChars'];
            $changeChar = $secnc['changeBadChars'];
        }

        if( ! is_array($badWords) )
        {
            return $string = Regex::replace($badWords, $changeChar, $string, 'xi');
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

            $string = Regex::replace($value, $ch, $string, 'xi');
        }

        return $string;
    }
}
