<?php namespace ZN\ViewObjects\View\BS;

use Html, Buffer;

class ListGroup implements ListGroupInterface
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
    // List Group
    //--------------------------------------------------------------------------------------------------------
    //
    // @param callable $pager
    //
    //--------------------------------------------------------------------------------------------------------
    public function listGroup(Callable $list) : String
    {
        $return  = '<ul class="list-group">' . EOL;
        $return .= Buffer::callback($list, [$this]);
        $return .= '</ul>';

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Li
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $url   = NULL
    // @param string $value = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function li(String $value = NULL)
    {
        echo HT . '<li class="list-group-item">' . $value . '</li>' . EOL;
    }
}
