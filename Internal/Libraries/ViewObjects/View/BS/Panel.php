<?php namespace ZN\ViewObjects\View\BS;

class Panel implements PanelInterface
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
    // Panel
    //--------------------------------------------------------------------------------------------------------
    //
    // @param callable $pager
    //
    //--------------------------------------------------------------------------------------------------------
    public function panel(String $heading = NULL, String $content = NULL) : String
    {
        $return  = '<div class="panel panel-'. (Properties::$type ?? 'default') .'">';
        $return .= '<div class="panel-heading">'.$heading.'</div>';
        $return .= '<div class="panel-body">'.$content.'</div>';
        $return .= '</div>';

        Properties::$type = NULL;

        return $return;
    }
}
