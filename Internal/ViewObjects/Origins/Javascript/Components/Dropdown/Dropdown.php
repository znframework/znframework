<?php namespace ZN\ViewObjects\Javascript\Components;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use Html, Form;

class Dropdown extends ComponentsExtends
{
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

        return $this->prop
        ([
            'li'       => $this->li     ?? [],
            'value'    => $value,
            'button'   => $this->button ?? NULL,
            'class'    => $this->class  ?? 'btn-default',
            'type'     => $this->type   ?? 'down'
        ]);
    }
}
