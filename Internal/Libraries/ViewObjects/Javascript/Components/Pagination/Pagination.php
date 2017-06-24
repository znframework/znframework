<?php namespace ZN\ViewObjects\Javascript\Components;

use Config;

class Pagination extends ComponentsExtends
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

        $i             = 0;
        $attr['get']   = $get;
        $attr['index'] = $i++;
        $attr['type']  = $this->type ?? Config::get('ViewObjects', 'pagination')['type'];

        return $this->prop($attr);
    }
}
