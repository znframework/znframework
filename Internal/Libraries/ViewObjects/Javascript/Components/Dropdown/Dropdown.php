<?php namespace ZN\ViewObjects\Javascript\Components;

use Html, Form;

class Dropdown extends ComponentsExtends
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    protected $li = [];

    //--------------------------------------------------------------------------------------------------------
    // Divider
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function divider()
    {
        $this->li[] = '<li class="divider"></li>';

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
        $this->li[] = '<li class="dropdown-header">' . $content . '</li>';

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

        $this->li[] ='<li'.($active ?? NULL).'>' . Html::attr($attr)->anchor($url, $content) . '</li>';

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Generate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string   $value
    // @param callable $dropdown
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(String $value, Callable $dropdowns) : String
    {
        $dropdowns($this);

        $attr['li']       = $this->li     ?? [];
        $attr['value']    = $value;
        $attr['button']   = $this->button ?? NULL;
        $attr['class']    = $this->class  ?? 'btn-default';
        $attr['type']     = $this->type   ?? 'down';
        $attr['dropdown'] =
        [
            'type' => $this->type ?? 'down',
        ];

        return $this->prop($attr);
    }
}
