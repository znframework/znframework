<?php namespace ZN\IndividualStructures\Security;

interface NastyCodeInterface
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
    public function encode(String $string, $badWords = NULL, $changeChar = '[badchars]') : String;
}
