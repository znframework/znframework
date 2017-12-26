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

class Charts extends ComponentsExtends
{
    //--------------------------------------------------------------------------------------------------------
    // Generate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $type = 'area'
    // @param calable $charts
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(String $type = 'area', Callable $charts) : String
    {
        $charts($this);

        return $this->prop
        ([
            'type' => $type,
            'id'   => $this->id ?? 'morris-area-chart'
        ]);
    }
}
