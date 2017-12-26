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

use Html, Form;
use ZN\IndividualStructures\Buffer;

class GridSystem extends ComponentsExtends
{
    //--------------------------------------------------------------------------------------------------------
    // Row
    //--------------------------------------------------------------------------------------------------------
    //
    // @param callable $columns
    // @param array    $attr = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function row(Callable $columns, Array $attr = [])
    {
        $content = Buffer\Callback::do($columns, [$this]);

        echo Html::attr($attr)->class('row')->div($content);
    }

    //--------------------------------------------------------------------------------------------------------
    // Col
    //--------------------------------------------------------------------------------------------------------
    //
    // @poram scalar   $size
    // @param callable $code
    // @param array    $attr = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function col($size, Callable $code, Array $attr = [])
    {
        $content = Buffer\Callback::do($code, [new Form, new Html]);

        echo Html::attr($attr)->class('col-' . ( is_numeric($size) ? 'lg-' . $size : $size))->div($content);
    }

    //--------------------------------------------------------------------------------------------------------
    // Generate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param callable $grid
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(Callable $grid) : String
    {
        return $this->prop
        ([
            'contents' => Buffer\Callback::do($grid, [$this])
        ]);
    }
}
