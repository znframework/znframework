<?php namespace ZN\ViewObjects\Javascript\Components;

class Datatables extends ComponentsExtends
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
    // Speed
    //--------------------------------------------------------------------------------------------------------
    //
    // @param scalar $speed
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(Array $result, Array $attr = NULL)
    {
        $attr['result'] = $result;

        return \Import::page('Datatables/datatable-view', $attr, true, $this->_path());
    }
}
