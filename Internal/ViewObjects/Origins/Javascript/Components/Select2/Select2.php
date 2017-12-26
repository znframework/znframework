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

class Select2 extends ComponentsExtends
{
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
