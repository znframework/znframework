<?php namespace ZN\ViewObjects\Bootstrap\JSP;

interface FunctionsInterface
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
    // Define
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string   $functionName
    // @param mixed    $parameters
    // @param callable $function
    //
    //--------------------------------------------------------------------------------------------------------
    public function define(String $functionName = NULL, $parameters = NULL, $function = NULL);
}
