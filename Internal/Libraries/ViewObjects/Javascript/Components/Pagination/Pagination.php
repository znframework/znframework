<?php namespace ZN\ViewObjects\Javascript\Components;

class Pagination extends ComponentsExtends implements PaginationInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Generate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $get
    // @param array $attr = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate($get, Array $attr = NULL) : String
    {
        $i             = 0;
        $attr['get']   = $get;
        $attr['index'] = $i++;

        return $this->load('Pagination/View', $attr);
    }
}
