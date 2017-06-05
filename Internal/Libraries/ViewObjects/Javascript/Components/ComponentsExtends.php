<?php namespace ZN\ViewObjects\Javascript\Components;

use Import, RevolvingAbility;

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

    use RevolvingAbility;

    protected function load($path, $attr) : String
    {
        return Import::page($path, $attr, true, realpath(__DIR__) . DS);
    }
}
