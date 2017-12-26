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

use Config;

class Pagination extends ComponentsExtends
{
    protected $index = 0;

    //--------------------------------------------------------------------------------------------------------
    // Generate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed    $get
    // @param callable $paginations = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate($get, Callable $paginations = NULL) : String
    {
        if( $paginations !== NULL )
        {
            $paginations($this);
        }

        return $this->prop
        ([
            'get'   => $get,
            'index' => $this->index++,
            'type'  => $this->type ?? Config::get('ViewObjects', 'pagination')['type']
        ]);
    }
}
