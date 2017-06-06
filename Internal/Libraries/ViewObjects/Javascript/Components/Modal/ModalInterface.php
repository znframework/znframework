<?php namespace ZN\ViewObjects\Javascript\Components;

interface ModalInterface
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
    // @param string   $id   = 'myModal'
    // @param callable $modalboxs
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(String $id = 'myModal', Callable $modalboxs) : String;
}
