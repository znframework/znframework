<?php namespace ZN\Components\FlexSlider;
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
    // @param string   $id   = 'datepicker'
    // @param callable $flexsliders
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(String $id = 'flexslider', Callable $flexsliders) : String
    {
        $flexsliders($this);

        return $this->prop
        ([
            'id'     => $id,
            'path'   => $this->path ? suffix($this->path) : NULL,
            'images' => $this->images ?? NULL
        ]);
    }
}
