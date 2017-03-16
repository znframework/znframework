<?php namespace ZN\ViewObjects\Bootstrap\JSP;

use JQ;

class Output implements OutputInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    public function alert(String $value)
    {
        echo 'alert(' . JQ::stringControl($value) . ');' . EOL;
    }

    public function write(String $value)
    {
        echo 'document.write(' . JQ::stringControl($value) . ');' . EOL;
    }
}
