<?php namespace ZN\ViewObjects\Bootstrap\JSP;

class Statements
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------
    
    public function if($condition, $callback)
    {
        echo 'if(' . $condition . ') { ' . EOL;
        echo $callback();
        echo '}' . EOL;
    }

    public function elseif($condition, $callback)
    {
        echo 'else if(' . $condition . ') { ' . EOL;
        echo $callback();
        echo '}' . EOL;
    }

    public function else($callback)
    {
        echo 'else{ ' . EOL;
        echo $callback();
        echo '}' . EOL;
    }

    public function switch($condition, $callback)
    {
        echo 'switch(' . $condition . '){' . EOL;
        echo $callback();
        echo '}' . EOL;
    }

    public function case($condition, $callback)
    {
        echo 'case ' . $condition . ' :' . EOL;
        echo $callback() . EOL;
    }

    public function defaultCase($callback)
    {
        echo 'default:' . EOL;
        echo $callback() . EOL;
    }

    public function break()
    {
        echo 'break;' . EOL;
    }
}
