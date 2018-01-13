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

class Datatables extends ComponentsExtends
{
    //--------------------------------------------------------------------------------------------------------
    // Generate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed    $result
    // @param callable $datatable = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate($result, Callable $datatable = NULL) : String
    {
        if( $datatable !== NULL )
        {
            $datatable($this);
        }

        return $this->prop
        ([
            'result'  => $result,
            'width'   => $this->width   ?? '100%',
            'id'      => $this->id      ?? 'datatable',
            'class'   => $this->class   ?? 'table-striped table-bordered table-hover',
            'process' => $this->process ?? NULL,
            'length'  => $this->length  ?? 100
        ]);
    }
}
