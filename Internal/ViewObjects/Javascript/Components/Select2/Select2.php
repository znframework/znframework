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

        return $this->prop
        ([
            'id'       => $id,
            'multiple' => $this->multiple ?? NULL,
            'table'    => $this->table    ?? NULL,
            'query'    => $this->query    ?? NULL,
            'class'    => $this->class    ?? NULL,
            'name'     => $this->name     ?? $id,
            'data'     => $this->data     ?? [],
            'selected' => $this->selected ?? 0
        ]);
    }
}
