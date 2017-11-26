<?php namespace Project\Controllers;

use ZN\IndividualStructures\Import\View as Page;

class View
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    use ViewTrait;

    public static function get(String $file = NULL, $usable = false)
    {
        return Page::use($file, [], $usable);
    }
}

class_alias('Project\Controllers\View', 'View');
