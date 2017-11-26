<?php namespace ZN\ViewObjects\Javascript\Components;

use RevolvingAbility, Classes;
use ZN\DataTypes\Arrays\RemoveElement;
use ZN\DataTypes\Arrays\Element;
use ZN\IndividualStructures\Import\View;

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
        return View::use($path, $attr, true, realpath(__DIR__) . DS);
    }

    protected function prop($attr, $view = NULL)
    {
        $attr['autoloadExtensions'] = $this->autoloadExtensions ?? false;
        $attr['extensions']         = $this->extensions         ?? [];
        $attr['attributes']         = $this->attributes         ?? [];
        $attr['properties']         = $this->properties         ?? RemoveElement::key((array) $this->revolvings, Element::keys($attr));

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
