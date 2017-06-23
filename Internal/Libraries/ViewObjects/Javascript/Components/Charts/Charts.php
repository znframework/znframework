<?php namespace ZN\ViewObjects\Javascript\Components;

class Charts extends ComponentsExtends
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
    // @param string  $type = 'area'
    // @param calable $charts
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(String $type = 'area', Callable $charts) : String
    {
        $charts($this);

        $attr['type'] = $type;
        $attr['id']   = $this->id ?? 'morris-area-chart';

        return $this->prop($attr);
    }
}
