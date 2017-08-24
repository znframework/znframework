<?php namespace ZN\ViewObjects\Javascript\Components;

class Datepicker extends ComponentsExtends
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
    // @param string   $id   = 'datepicker'
    // @param callable $datapickers
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(String $id = 'datepicker', Callable $datepickers) : String
    {
        $datepickers($this);

        $attr['id']    = $id;
        $attr['class'] = $this->class ?? NULL;
        $attr['name']  = $this->name  ?? NULL;

        return $this->prop($attr);
    }
}
