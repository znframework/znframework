<?php namespace ZN\ViewObjects\Bootstrap\JSP;

class JSPExtends
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    protected function _statements($condition, $callback, $function)
    {
        echo $function . ( ! empty($condition) ? '(' . $condition . ')' : '' ) .'{ ' . EOL;
        echo $callback();
        echo '}' . EOL;
    }
}
