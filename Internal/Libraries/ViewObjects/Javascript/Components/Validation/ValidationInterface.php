<?php namespace ZN\ViewObjects\Javascript\Components;

interface ValidationInterface
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
    // @param callable $form
    // @param array    $attr = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(Callable $form, Array $attr = NULL) : String;
}
