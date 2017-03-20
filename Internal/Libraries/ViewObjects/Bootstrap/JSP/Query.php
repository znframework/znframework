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

    public function selector(String $selector)
    {
        Jquery::selector($selector);

        return $this;
    }

    public function property(...$args)
    {
        Jquery::property(...$args);

        return $this;
    }

    public function complete()
    {
        echo Jquery::create();
    }
}
