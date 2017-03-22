<?php namespace ZN\ViewObjects\Bootstrap\JSP;

use Jquery;

class Ajax implements AjaxInterface
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
    // Send
    //--------------------------------------------------------------------------------------------------------
    //
    // @param callable $callback
    //
    //--------------------------------------------------------------------------------------------------------
    public function send(Callable $callback)
    {
        $class = Jquery::ajax();

        echo $callback($class) . EOL;
        echo $class->send();
    }
}
