<?php namespace ZN\ViewObjects\Javascript\Components;

use Import, RevolvingAbility, Arrays;

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

    protected function prop($array)
    {
        return Arrays::removeKey($this->revolvings, Arrays::keys($array));
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
