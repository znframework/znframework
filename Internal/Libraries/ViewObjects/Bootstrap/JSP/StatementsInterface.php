<?php namespace ZN\ViewObjects\Bootstrap\JSP;

interface StatementsInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    public function if(String $condition, Callable $callback);

    public function elseif(String $condition, Callable $callback);

    public function else(Callable $callback);

    public function switch(String $condition, Callable $callback);

    public function case(String $condition, Callable $callback);

    public function default(Callable $callback);

    public function break();

    public function return(String $data = NULL);
}
