<?php namespace ZN\ViewObjects\Javascript\Components;

use Arrays;

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
    // @param string  $type = 'area'
    // @param calable $charts
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(String $type = 'area', Callable $charts) : String
    {
        $charts($this);

        $attr['type'] = $type;
        $attr['id']   = $this->id      ?? 'morris-area-chart';

        $attr['autoloadExtensions'] = $this->autoloadExtensions ?? false;
        $attr['extensions']         = $this->extensions         ?? [];
        $attr['attributes']         = $this->attributes         ?? [];
        $attr['properties']         = $this->properties         ?? $this->prop($attr);

        $this->defaultVariable();

        return $this->load('Charts/View', $attr);
    }
}
