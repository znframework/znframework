<?php namespace ZN\DataTypes\Arrays;

class Search
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
    // Search
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $element
    // @param bool  $strict
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(Array $array, $element, Bool $strict = false)
    {
        return array_search($element, $array, $strict);
    }
}
