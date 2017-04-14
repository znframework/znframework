<?php namespace ZN\ViewObjects\View\BS;

use Html, Form;

class Button implements ButtonInterface
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
    // Button Link
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $url   = NULL
    // @param string $value = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function buttonLink(String $url = NULL, String $value = NULL) : String
    {
        $return = Html::role('button')->class('btn'. (Properties::$type ? ' btn-'.Properties::$type : NULL))->anchor($url, $value);

        Properties::$type = NULL;

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Button
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name  = NULL
    // @param string $value = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function button(String $name = NULL, String $value = NULL) : String
    {
        $return = Form::class('btn'. (Properties::$type ? ' btn-'.Properties::$type : NULL))->button($name, $value);

        Properties::$type = NULL;

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Submit
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name  = NULL
    // @param string $value = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function submit(String $name = NULL, String $value = NULL) : String
    {
        $return = Form::class('btn'. (Properties::$type ? ' btn-'.Properties::$type : NULL))->submit($name, $value);

        Properties::$type = NULL;

        return $return;
    }
}
