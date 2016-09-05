<?php namespace ZN\Requirements\Controllers;

class RevolvingController
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Call
    //--------------------------------------------------------------------------------------------------------
    //
    // Magic Call
    //
    //--------------------------------------------------------------------------------------------------------
    public function __call($method, $param)
    {
        $this->$method = $param[0] ?? NULL;

        return $this;
    }
}

class_alias('ZN\Requirements\Controllers\RevolvingController', 'RevolvingController');
