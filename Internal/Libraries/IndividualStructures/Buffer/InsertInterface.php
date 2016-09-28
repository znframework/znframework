<?php namespace ZN\IndividualStructures\Buffer;

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
    // Do
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string                 $name
    // @param  callable/object/string $data
    // @param  array                  $params
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do(String $name, $data, Array $params = []) : Bool;
}
