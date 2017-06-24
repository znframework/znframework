<?php namespace ZN\ViewObjects\Javascript\Components;

class Select2 extends ComponentsExtends
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
    // @param string   $id   = 'select2'
    // @param callable $select2
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(String $id = 'select2', Callable $select2) : String
    {
        $select2($this);

        $attr['id']       = $id;
        $attr['multiple'] = $this->multiple ?? NULL;
        $attr['table']    = $this->table    ?? NULL;
        $attr['query']    = $this->query    ?? NULL;
        $attr['class']    = $this->class    ?? NULL;
        $attr['name']     = $this->name     ?? $id;
        $attr['data']     = $this->data     ?? [];
        $attr['selected'] = $this->selected ?? 0;

        return $this->prop($attr);
    }
}
