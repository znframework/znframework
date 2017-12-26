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

class Ajax extends ComponentsExtends
{
    //--------------------------------------------------------------------------------------------------------
    // Generate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string   $id   = 'editor'
    // @param callable $editors
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(String $function, Callable $ajax = NULL) : String
    {
        if( $ajax !== NULL )
        {
            $ajax($this);
        }
        
        return $this->prop(['function' => $function]);
    }
}
