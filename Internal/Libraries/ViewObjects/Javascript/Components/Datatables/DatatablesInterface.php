<?php namespace ZN\ViewObjects\Javascript\Components;

interface DatatablesInterface
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
    // Generate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $result
    // @param array $attr = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(Array $result, Array $attr = NULL);
}
