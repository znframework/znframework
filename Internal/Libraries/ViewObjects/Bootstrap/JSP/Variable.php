<?php namespace ZN\ViewObjects\Bootstrap\JSP;

use JS, JQ;

class Variable implements VariableInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    public function var(String $variable, String $value = NULL)
    {
        echo JS::var($variable, $value, true);
    }

    public function varch(String $variable, String $value = NULL)
    {
        echo JS::varch($variable, $value);
    }

    public function vardec(String $variable, Int $decrement = 1)
    {
        echo JQ::vardec($variable, $decrement);
    }

    public function varinc(String $variable, Int $decrement = 1)
    {
        echo JQ::varinc($variable, $decrement);
    }
}
