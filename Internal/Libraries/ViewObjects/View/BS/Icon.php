<?php namespace ZN\ViewObjects\View\BS;

class Icon implements IconInterface
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
    // Icon
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $icon = 'envelope'
    //
    //--------------------------------------------------------------------------------------------------------
    public function icon(String $icon = 'envelope') : String
    {
        return '<span class="glyphicon glyphicon-'. $icon .'"></span>';
    }
}
