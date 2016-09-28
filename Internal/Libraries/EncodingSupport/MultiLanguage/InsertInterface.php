<?php namespace ZN\EncodingSupport\MultiLanguage;

interface InsertInterface
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
    // Insert
    //--------------------------------------------------------------------------------------------------------
    //
    // Dil dosyasına kelime eklemek için kullanılır.
    // @param string $app
    // @param mixed  $key
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(String $app, $key, String $data = NULL) : Bool;
}
