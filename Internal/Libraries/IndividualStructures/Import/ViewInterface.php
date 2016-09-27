<?php namespace ZN\IndividualStructures\Import;

interface ViewInterface
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
    // page()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $page
    // @param array  $data
    // @param bool   $obGetContents
    //
    //--------------------------------------------------------------------------------------------------------
    public function use(String $page, Array $data = NULL, Bool $obGetContents = false, String $randomPageDir = VIEWS_DIR);
}
