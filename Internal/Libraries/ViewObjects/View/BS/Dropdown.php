<?php namespace ZN\ViewObjects\View\BS;

use Buffer, Html;

class Dropdown implements DropdownInterface
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
    // Dropdown
    //-------------------------------------------s-------------------------------------------------------------
    //
    // @param string   $name = NULL
    // @param callable $callback
    //
    //--------------------------------------------------------------------------------------------------------
    public function dropdown(String $name = NULL, Callable $callback) : String
    {
        $return  = '<div class="dropdown">' . EOL;
        $return .= HT . '<button class="btn btn-'.( Properties::$type ?? 'primary' ).' dropdown-toggle" type="button" data-toggle="dropdown">' . $name ;
        $return .= ' <span class="caret"></span></button>' . EOL;
        $return .= HT . '<ul class="dropdown-menu">' . EOL;
        $return .= Buffer::callback($callback, [$this]);
        $return .= HT . '</ul>' . EOL;
        $return .= '</div>';

        Properties::$type = NULL;

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Option
    //-------------------------------------------s-------------------------------------------------------------
    //
    // @param string $url   = NULL
    // @param string $value = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function option(String $url = NULL, String $value = NULL)
    {
        echo HT . HT . '<li>'. Html::anchor($url, $value) .'</li>' . EOL;
    }
}
