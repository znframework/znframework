<?php namespace ZN\ViewObjects\Bootstrap\JSP;

interface QueryInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    public function create(String $selector, Callable $callback);

    public function selector(String $selector) : Query;

    public function property(...$args) : Query;

    public function complete();
}
