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
