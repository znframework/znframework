<?php namespace ZN\ViewObjects\Bootstrap\JSP;

class Functions implements FunctionsInterface
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
    public function define(String $functionName = NULL, $parameters = NULL, $function = NULL)
    {
        if( ( is_scalar($parameters) || $parameters === NULL ) && $function === NULL )
        {
            echo $functionName . '(' . $parameters . ');' . EOL;

            return;
        }

        $params = $parameters;

        if( is_callable($parameters) )
        {
            $params   = '';
            $function = $parameters;
        }

        echo 'function ' . $functionName . '(' . $params . '){' . EOL;
        echo $function();
        echo '}' . EOL;
    }
}
