<?php namespace ZN\ViewObjects\View\BS;

use Html;

class Collapse implements CollapseInterface
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
    // Collapse
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $target  = NULL
    // @param string $content = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function collapse(String $buttonName, String $content = NULL) : String
    {
        $unique  = 'id' . uniqid();

        $return  = Html::class(Properties::$type ? 'btn btn-'.Properties::$type : 'btn')->attr(['data-toggle' => 'collapse', 'data-target' => '#' . $unique])->button($buttonName);
        $return .= Html::class('collapse')->id($unique)->div($content);

        Properties::$type = NULL;

        return $return;
    }
}
