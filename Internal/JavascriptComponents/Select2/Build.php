<?php namespace ZN\JavascriptComponents\Select2;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\JavascriptComponents\ComponentsExtends;

class Build extends ComponentsExtends
{
    /**
     * Generate Select2
     * 
     * @param string   $id = 'seletc2'
     * @param callable $select2
     * 
     * @return string
     */
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
