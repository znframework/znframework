<?php namespace ZN\ViewObjects\Bootstrap\JSP;

use Jquery, Buffer;

class Ajax
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    public function send($callback)
    {
        $ajax = Jquery::ajax();

        echo $callback($ajax) . EOL;
        echo $ajax->send();
    }
}
