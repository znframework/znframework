<?php namespace ZN\IndividualStructures\Security;

class CrossSiteScripting
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
    // Script Bad Chars
    //--------------------------------------------------------------------------------------------------------
    //
    // Genel Kullanımı: Script saldırılarına neden olacak karater listesi.
    //
    //--------------------------------------------------------------------------------------------------------
    protected static $scriptBadChars =
    [
        'document\.cookie' => 'document&#46;cookie',
        'document\.write'  => 'document&#46;write',
        '\.parentNode'     => '&#46;parentNode',
        '\.innerHTML'      => '&#46;innerHTML',
        '\-moz\-binding'   => '&#150;moz&#150;binding',
        '<'                => '&#60;',
        '>'                => '&#62;',
    ];

    //--------------------------------------------------------------------------------------------------------
    // Xss Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    //
    //--------------------------------------------------------------------------------------------------------
    public static function encode(String $string) : String
    {
        $secBadChars = self::$scriptBadChars;

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
