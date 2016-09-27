<?php namespace ZN\DataTypes\Separator;

interface EncodeInterface
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
    // @param array  $data
    // @param string $key
    // @param string $separator
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(Array $data, String $key = NULL, String $separator = NULL) : String;
}
