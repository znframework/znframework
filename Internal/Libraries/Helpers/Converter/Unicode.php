<?php namespace ZN\Helpers\Converter;

use Config, Arrays;
use ZN\Helpers\Converter\Exception\InvalidArgumentException;
use ZN\Helpers\Converter\Exception\LogicException;

class Unicode implements UnicodeInterface
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
    // Char
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    // @param string $type      : char, dec, hex, html
    // @param string $changeType: char, dec, hex, html
    //
    //--------------------------------------------------------------------------------------------------------
    public function char(String $string, String $type = 'char', String $changeType = 'html') : String
    {
        $options = ['char', 'html', 'hex', 'dec'];

        if( ! in_array($type, $options) || ! in_array($changeType, $options) )
        {
            throw new InvalidArgumentException('[Converter::char()] -> Available Options: [char], [html], [hex], [dec]  For 2.($type) & 3.($changeType)!');
        }

        if( $type === $changeType )
        {
            throw new LogicException('[Converter::char()] -> 2.($type) & 3.($changeType) parameters [can not be equal]!');
        }

        $string = $this->accent($string);

        if( ! is_string($type) )
        {
            $type = 'char';
        }

        if( ! is_string($changeType) )
        {
            $changeType = 'html';
        }

        for( $i = 32; $i <= 255; $i++ )
        {
            $hexRemaining = ( $i % 16 );
            $hexRemaining = str_replace( [10, 11, 12, 13, 14, 15], ['A', 'B', 'C', 'D', 'E', 'F'], $hexRemaining );
            $hex          = ( floor( $i / 16) ).$hexRemaining;

            if( $hex[0] == '0' )
            {
                $hex = $hex[1];
            }

            if( chr($i) !== ' ' )
            {
                $chars['char'][] = chr($i);
                $chars['dec'][]  = $i." ";
                $chars['hex'][]  = $hex." ";
                $chars['html'][] = "&#{$i};";
            }
        }

        return str_replace( $chars[strtolower($type)], $chars[strtolower($changeType)], $string );
    }

    //--------------------------------------------------------------------------------------------------------
    // Accent
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function accent(String $str) : String
    {
        $accent = Config::get('ForeignChars', 'accentChars');

        $accent = Arrays::multikey($accent);

        return str_replace(array_keys($accent), array_values($accent), $str);
    }

    //--------------------------------------------------------------------------------------------------------
    // Url Word
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param string $splitWord
    //
    //--------------------------------------------------------------------------------------------------------
    public function urlWord(String $str, String $splitWord = '-') : String
    {
        $badChars = Config::get('IndividualStructures', 'security')['urlBadChars'];

        $str = $this->accent($str);
        $str = str_replace($badChars, '', $str);
        $str = preg_replace("/\s+/", ' ', $str);
        $str = str_replace("&nbsp;", '', $str);
        $str = str_replace(' ', $splitWord, trim(strtolower($str)));

        return $str;
    }

    //--------------------------------------------------------------------------------------------------------
    // Charset
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param string $fromCharset
    // @param string $toCharset
    //
    //--------------------------------------------------------------------------------------------------------
    public function charset(String $str, String $fromCharset, String $toCharset = 'utf-8') : String
    {
        return mb_convert_encoding($str, $fromCharset, $toCharset);
    }
}
