<?php namespace ZN\IndividualStructures\Security;

class CrossSiteScripting extends SecurityExtends implements CrossSiteScriptingInterface
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
    // Xss Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    //
    //--------------------------------------------------------------------------------------------------------
    public function encode(String $string) : String
    {
        $secBadChars = INDIVIDUALSTRUCTURES_SECURITY_CONFIG['scriptBadChars'];

        if( ! empty($secBadChars) )
        {
            foreach( $secBadChars as $badChar => $changeChar )
            {
                if( is_numeric($badChar) )
                {
                    $badChar = $changeChar;
                    $changeChar = '';
                }

                $badChar = trim($badChar, '/');

                $string = preg_replace('/'.$badChar.'/xi', $changeChar, $string);
            }
        }

        return $string;
    }
}
