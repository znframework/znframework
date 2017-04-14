<?php namespace ZN\ViewObjects\View\BS;

use Html;

class Well implements WellInterface
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
    // Well
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $value   = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function use(String $value = NULL) : String
    {
        $return = Html::class('well' . (Properties::$type ? ' well-' . Properties::$type : NULL ))->div($value);

        Properties::$type = NULL;

        return $return;
    }
}
