<?php namespace ZN\JavascriptComponents\GridSystem;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Hypertext\Html;
use ZN\Hypertext\Form;
use ZN\Buffering;
use ZN\JavascriptComponents\ComponentsExtends;

class Build extends ComponentsExtends
{
    /**
     * Creates row
     * 
     * @param callable $columns
     * @param array    $attr = []
     */
    public function row(Callable $columns, Array $attr = [])
    {
        $content = Buffering\Callback::do($columns, [$this]);

        echo Html::attr($attr)->class('row')->div($content);
    }

    /**
     * Creates column
     * 
     * @param string|int $size
     * @param callable   $code
     * @param array      $attr = []
     */
    public function col($size, Callable $code, Array $attr = [])
    {
        $content = Buffering\Callback::do($code, [new Form, new Html]);

        echo Html::attr($attr)->class('col-' . ( is_numeric($size) ? 'lg-' . $size : $size))->div($content);
    }

    /**
     * Generate Grid System
     * 
     * @param callable $grid
     * 
     * @return string
     */
    public function generate(Callable $grid) : String
    {
        return $this->prop
        ([
            'contents' => Buffering\Callback::do($grid, [$this])
        ]);
    }
}
