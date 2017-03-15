<?php namespace ZN\ViewObjects\Bootstrap\JSP;

use Jquery;

class Query implements QueryInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    public function create(String $selector, Callable $callback)
    {
        $class = new Jquery;

        $class->selector($selector);
        echo $callback($class) . EOL;
        echo $class->create();
    }
}
