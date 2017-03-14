<?php namespace ZN\ViewObjects\Bootstrap\JSP;

use Script;

class Run
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------
    
    public function use($jquery = true, $callback)
    {
        echo Script::open(false, $jquery);
        echo $callback();
        echo Script::close();
    }
}
