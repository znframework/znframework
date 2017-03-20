<?php namespace ZN\ViewObjects\Bootstrap\JSP;

use JS;

class Loops implements LoopsInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    public function while(String $condition, Callable $callback)
    {
        echo JS::while($condition, $callback);
    }

    public function doWhile(String $condition, Callable $callback)
    {
        echo JS::doWhile($condition, $callback);
    }

    public function for(String $condition, Callable $callback)
    {
        echo JS::for($condition, $callback);
    }
}
