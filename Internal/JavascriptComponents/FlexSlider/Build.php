<?php namespace ZN\JavascriptComponents\FlexSlider;
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
     * Generate Flex Slider
     * 
     * @param string   $id = 'flexslider'
     * @param callable $flexsliders
     * 
     * @return string
     */
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
