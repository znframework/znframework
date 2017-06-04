<?php namespace ZN\ViewObjects\Javascript\Components;

interface FlexSliderInterface
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
    // @param string $id   = 'datepicker'
    // @param array  $attr = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(String $id = 'flexslider', Array $attr = NULL) : String;
}
