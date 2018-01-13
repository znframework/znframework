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

class Datepicker extends ComponentsExtends
{
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

        return $this->prop
        ([
            'id'    => $id,
            'class' => $this->class ?? NULL,
            'name'  => $this->name  ?? NULL
        ]);
    }
}
