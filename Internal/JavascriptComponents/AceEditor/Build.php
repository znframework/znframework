<?php namespace ZN\JavascriptComponents\AceEditor;
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
    // @param string   $id   = 'editor'
    // @param callable $editors
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(String $id = 'editor', Callable $editors) : String
    {
        $editors($this);

        return $this->prop
        ([
            'id' => $id
        ]);

    }
}
