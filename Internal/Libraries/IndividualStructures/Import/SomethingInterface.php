<?php namespace ZN\IndividualStructures\Import;

interface SomethingInterface
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
    // something()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $page
    // @param array  $data
    // @param bool   $contents
    //
    //--------------------------------------------------------------------------------------------------------
    public function use(string $randomPageVariable, ? array $randomDataVariable = NULL, bool $randomObGetContentsVariable = false);
}
