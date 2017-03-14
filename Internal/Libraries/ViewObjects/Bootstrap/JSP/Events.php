<?php namespace ZN\ViewObjects\Bootstrap\JSP;

use Jquery, Buffer;

class Events
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------
    
    public function addEventListener($selector, $event, $callback)
    {
        echo Jquery::event()->$event($selector, Buffer::callback($callback));
    }

    public function removeEventListener($selector, $event)
    {
        echo Jquery::event()->selector($selector)->unbind('', $event);
    }
}
