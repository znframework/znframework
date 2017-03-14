<?php namespace ZN\ViewObjects\Bootstrap\JSP;

class Ready
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------
    
    public function use($callback)
    {
        echo '$(document).ready(function()' . EOL .'{' . EOL;
        echo $callback();
        echo EOL . '});' . EOL;
    }
}
