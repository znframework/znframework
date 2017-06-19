<?php namespace ZN\ViewObjects\Javascript\Components;

use Import, RevolvingAbility, Arrays, Classes;

class ComponentsExtends
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    use RevolvingAbility;

    protected $button = NULL;

    protected function load($path, $attr) : String
    {
        return Import::page($path, $attr, true, realpath(__DIR__) . DS);
    }

    protected function prop(&$attr, $view = NULL)
    {
        $attr['autoloadExtensions'] = $this->autoloadExtensions ?? false;
        $attr['extensions']         = $this->extensions         ?? [];
        $attr['attributes']         = $this->attributes         ?? [];
        $attr['properties']         = $this->properties         ?? Arrays::removeKey($this->revolvings, Arrays::keys($attr));

        $this->defaultVariable();

        return $this->load(($view ?? Classes::onlyName(get_called_class())) . '/View', $attr);
    }

    public function button(String $name, String $value, Array $attr = [])
    {
        $this->button =
        [
            'name'       => $name,
            'value'      => $value,
            'attributes' => $attr,
            'class'      => $this->class ?? 'btn-info'
        ];

        $this->class  = NULL;

        return $this;
    }
}
