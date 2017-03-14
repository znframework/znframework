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
    
    public function method($data)
    {
        Jquery::ajax()->method($data);
    }

    public function data($data)
    {
        Jquery::ajax()->data($data);
    }

    public function dataType($data)
    {
        Jquery::ajax()->dataType($data);
    }

    public function success($data, $callback)
    {
        Jquery::ajax()->success($data, Buffer::callback($callback));
    }

    public function error($data, $callback)
    {
        Jquery::ajax()->errr($data, Buffer::callback($callback));
    }

    public function url($data)
    {
        Jquery::ajax()->url($data);
    }

    public function send($callback)
    {
        echo $callback() . EOL;
        echo Jquery::ajax()->send();
    }
}
