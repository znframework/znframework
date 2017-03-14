<?php namespace ZN\ViewObjects\Bootstrap\JSP;

class Loops
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------
    
    public function while($condition, $callback)
    {
        echo 'while(' . $condition . ') { ' . EOL;
        echo $callback();
        echo '}' . EOL;
    }

    public function doWhile($condition, $callback)
    {
        echo 'do{ ' . EOL;
        echo $callback();
        echo '}while(' . $condition . ');' . EOL;
    }

    public function for($condition, $callback)
    {
        echo 'for(' . $condition . ') {' . EOL;
        echo $callback();
        echo '}' . EOL;
    }
}
