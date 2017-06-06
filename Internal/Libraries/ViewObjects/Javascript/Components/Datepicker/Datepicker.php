<?php namespace ZN\ViewObjects\Javascript\Components;

use Arrays;

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

        $attr['autoloadExtensions'] = $this->autoloadExtensions ?? false;
        $attr['extensions']         = $this->extensions         ?? [];
        $attr['attributes']         = $this->attributes         ?? [];
        $attr['properties']         = $this->properties         ?? Arrays::removeKey($this->revolvings,
        [
            'autoloadExtensions', 'extensions', 'attributes', 'properties', 'class', 'name'
        ]);

        $this->defaultVariable();

        return $this->load('Datepicker/View', $attr);
    }
}
