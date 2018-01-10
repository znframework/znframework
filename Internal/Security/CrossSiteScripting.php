<?php namespace ZN\Security;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class CrossSiteScripting
{
    /**
     * Script Bad Chars
     * 
     * @var array
     */
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

    /**
     * Encode Cross Site Scripting
     * 
     * @param string $string 
     * 
     * @return string
     */
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
