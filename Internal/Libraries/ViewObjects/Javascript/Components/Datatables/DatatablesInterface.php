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
    // @param mixed    $result
    // @param callable $datatable = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate($result, Callable $datatable = NULL) : String;
}
