<?php namespace ZN\Helpers\Limiter;

class Word implements CommonInterface
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
    public function do(String $str, Int $limit = 100, String $endChar = '...', Bool $stripTags = true, String $encoding = "utf-8") : String
    {
        $str = trim($str);

        if( $stripTags === true )
        {
            $str = strip_tags($str);
        }

        $str = str_replace(["\n","\r","&nbsp;"], " ", $str);

        preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/', $str, $matches);

        $match = $matches[0] ?? NULL;

        if( mb_strlen($str, $encoding) === mb_strlen($match, $encoding) )
        {
            $endChar = '';
        }

        return rtrim($match ?? NULL).$endChar;
    }
}
