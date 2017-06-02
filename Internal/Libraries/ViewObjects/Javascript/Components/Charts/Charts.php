<?php namespace ZN\ViewObjects\Javascript\Components;

class Charts extends ComponentsExtends implements ChartsInterface
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
    // @param string $type = 'area'
    // @param array  $attr = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(String $type = 'area', Array $attr = NULL) : String
    {
        $attr['type'] = $type;

        return $this->load('Charts/View', $attr);
    }
}
