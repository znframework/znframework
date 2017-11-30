<?php namespace ZN\ViewObjects\Javascript\Components;

class Ajax extends ComponentsExtends
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
