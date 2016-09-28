<?php namespace ZN\Helpers\Limiter;

interface CommonInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------,

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
    public function do(String $str, Int $limit = 100, String $endChar = '...', Bool $stripTags = true, String $encoding = "utf-8") : String;
}
