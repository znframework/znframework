<?php namespace ZN\Components\Charts;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Components\ComponentsExtends;

class Build extends ComponentsExtends
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
