<?php namespace ZN\ViewObjects\Grids\Abstracts;

use Requirements;

abstract class GridAbstract extends Requirements
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
    // Create
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $app
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    abstract public function create() : String;
}