<?php namespace ZN\ViewObjects\Bootstrap\JSP;

use Jquery;

class Animate implements AnimateInterface
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
    // Create
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string   $selector
    // @param callable $callback
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(String $selector, Callable $callback)
    {
        $class = Jquery::animate();

        $class->selector($selector);
        echo $callback($class) . EOL;
        echo $class->create();
    }
}
