<?php namespace ZN\ViewObjects\Bootstrap\JSP;

interface VariableInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    public function var(String $variable, String $value = NULL);

    public function varch(String $variable, String $value = NULL);

    public function vardec(String $variable, Int $decrement = 1);

    public function varinc(String $variable, Int $decrement = 1);
}
