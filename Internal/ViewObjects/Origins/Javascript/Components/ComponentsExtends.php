<?php namespace ZN\ViewObjects\Javascript\Components;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use RevolvingAbility, Classes;
use ZN\DataTypes\Arrays;
use ZN\IndividualStructures\Import;

class ComponentsExtends
{
    use RevolvingAbility;

    protected $button = NULL;

    protected function load($path, $attr) : String
    {
        return Import\View::use($path, $attr, true, realpath(__DIR__) . DS);
    }

    protected function prop($attr, $view = NULL)
    {
        $attr['autoloadExtensions'] = $this->autoloadExtensions ?? false;
        $attr['extensions']         = $this->extensions         ?? [];
        $attr['attributes']         = $this->attributes         ?? [];
        $attr['properties']         = $this->properties         ?? Arrays\RemoveElement::key((array) $this->revolvings, array_keys($attr));

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
