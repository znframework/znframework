<?php namespace ZN\JavascriptComponents\Datepicker;
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
