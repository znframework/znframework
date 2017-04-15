<?php namespace ZN\ViewObjects\View\BS;

interface CollapseInterface
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
    // Collapse
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $target  = NULL
    // @param string $content = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function collapse(String $buttonName, String $content = NULL) : String;
}
