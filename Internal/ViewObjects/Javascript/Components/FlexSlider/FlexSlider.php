<?php namespace ZN\ViewObjects\Javascript\Components;

class FlexSlider extends ComponentsExtends
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
    // @param callable $flexsliders
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(String $id = 'flexslider', Callable $flexsliders) : String
    {
        $flexsliders($this);

        return $this->prop
        ([
            'id'     => $id,
            'path'   => $this->path ? suffix($this->path) : NULL,
            'images' => $this->images ?? NULL
        ]);
    }
}
