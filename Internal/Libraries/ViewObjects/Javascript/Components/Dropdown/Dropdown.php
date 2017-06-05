<?php namespace ZN\ViewObjects\Javascript\Components;

use Html, Form;

class Dropdown extends ComponentsExtends implements DropdownInterface
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
    // Divider
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function divider()
    {
        echo '<li class="divider"></li>';

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // header
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $content
    //
    //--------------------------------------------------------------------------------------------------------
    public function header(String $content = NULL)
    {
        echo '<li class="dropdown-header">' . $content . '</li>';

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // li
    //--------------------------------------------------------------------------------------------------------
    //
    // @param callable $columns
    // @param array    $attr = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function li(String $content = NULL, String $url = NULL, Array $attr = [])
    {
        if( strstr($url, CURRENT_CFURI) )
        {
            $active = ' class="active"';
        }

        echo '<li'.($active ?? NULL).'>' . Html::attr($attr)->anchor($url, $content) . '</li>';

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Generate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string   $value
    // @param callable $dropdown
    // @param array    $attr = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(String $value, Callable $dropdowns, Array $attr = NULL) : String
    {
        $attr['value']    = $value;
        $attr['dropdowns'] = $dropdowns;

        return $this->load('Dropdown/View', $attr);
    }
}
