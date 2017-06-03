<?php namespace ZN\ViewObjects\Javascript\Components;

class Datatables extends ComponentsExtends implements DatatablesInterface
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
    // @param mixed $result
    // @param array $attr = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate($result, Array $attr = NULL) : String
    {
        $attr['result'] = $result;

        return $this->load('Datatables/View', $attr);
    }
}
