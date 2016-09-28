<?php namespace ZN\Helpers\Limiter;

class Char implements CommonInterface
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
    // Do
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param int    $limit
    // @param string $endChar
    // @param bool   $stripTags
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(String $str, Int $limit = 500, String $endChar = '...',  Bool $stripTags = false, String $encoding = "utf-8") : String
    {
        $str = trim($str);

        if( $stripTags === true )
        {
            $str = strip_tags($str);
        }

        $str = preg_replace("/\s+/", ' ', str_replace(["\r\n", "\r", "\n", "&nbsp;"], ' ', $str));

        if( mb_strlen($str, $encoding) <= $limit )
        {
            return $str;
        }
        else
        {
            return mb_substr($str, 0, $limit, $encoding).$endChar;
        }
    }
}
