<?php namespace ZN\ViewObjects\Bootstrap\JSP;

class Statements implements StatementsInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    public function if(String $condition, Callable $callback)
    {
        echo 'if(' . $condition . ') { ' . EOL;
        echo $callback();
        echo '}' . EOL;
    }

    public function elseif(String $condition, Callable $callback)
    {
        echo 'else if(' . $condition . ') { ' . EOL;
        echo $callback();
        echo '}' . EOL;
    }

    public function else(Callable $callback)
    {
        echo 'else{ ' . EOL;
        echo $callback();
        echo '}' . EOL;
    }

    public function switch(String $condition, Callable $callback)
    {
        echo 'switch(' . $condition . '){' . EOL;
        echo $callback();
        echo '}' . EOL;
    }

    public function case(String $condition, Callable $callback)
    {
        echo 'case ' . $condition . ' :' . EOL;
        echo $callback() . EOL;
    }

    public function default(Callable $callback)
    {
        echo 'default:' . EOL;
        echo $callback() . EOL;
    }

    public function break()
    {
        echo 'break;' . EOL;
    }
}
