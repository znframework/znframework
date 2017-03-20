<?php namespace ZN\ViewObjects\Bootstrap\JSP;

use JQ, JS;

class Input
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    public function prompt($value)
    {
        echo JS::prompt($value, true);
    }

    public function val($selector, $value)
    {
        echo JQ::val($selector, $value, true);
    }

    public function text($selector, $value)
    {
        echo JQ::text($selector, $value, true);
    }

    public function html($selector, $value)
    {
        echo JQ::html($selector, $value, true);
    }
}
