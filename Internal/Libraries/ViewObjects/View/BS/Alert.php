<?php namespace ZN\ViewObjects\View\BS;

use Html;

class Alert implements AlertInterface
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
    public function use(String $value = NULL, Bool $dissmissable = NULL) : String
    {
        $close  = '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>';

        $return = Html::class('alert alert-' . (Properties::$type ?? 'success' ) . ($dissmissable === true ? ' alert-dismissable' : NULL ))
                      ->div(($dissmissable === true ? $close : NULL ) . $value);

        Properties::$type = NULL;

        return $return;
    }
}
