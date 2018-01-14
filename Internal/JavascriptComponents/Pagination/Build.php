<?php namespace ZN\JavascriptComponents\Pagination;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Config;
use ZN\JavascriptComponents\ComponentsExtends;

class Build extends ComponentsExtends
{
    /**
     * @var int
     */
    protected $index = 0;

    /**
     * Generate Ajax Pagination
     * 
     * @param mixed    $get
     * @param callable $paginations = NULL
     * 
     * @return string
     */
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
