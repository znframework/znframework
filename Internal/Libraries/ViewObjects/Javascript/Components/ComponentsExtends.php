<?php namespace ZN\ViewObjects\Javascript\Components;

use Import;

class ComponentsExtends
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    protected function load($path, $attr) : String
    {
        return Import::page($path, $attr, true, realpath(__DIR__) . DS);
    }
}
