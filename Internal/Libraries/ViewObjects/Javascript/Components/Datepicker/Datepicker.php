<?php namespace ZN\ViewObjects\Javascript\Components;

class Datepicker extends ComponentsExtends implements DatepickerInterface
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
    public function generate(String $id = 'datepicker', Array $attr = NULL) : String
    {
        $attr['id'] = $id;

        return $this->load('Datepicker/View', $attr);
    }
}
