<?php namespace ZN\CryptoGraphy\Encode;

interface GoldenAlgorithmInterface
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
    // Golden
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    // @param string $additional
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(String $data, String $additional = 'default') : String;
}
