<?php namespace ZN\JavascriptComponents\Dropdown;
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
use ZN\JavascriptComponents\ComponentsExtends;

class Build extends ComponentsExtends
{
    /**
     * Keeps li
     * 
     * @var array
     */
    protected $li = [];

    /**
     * Divider
     * 
     * @return self
     */
    public function divider()
    {
        $this->li[] = '<li class="divider"></li>';

        return $this;
    }

    /**
     * Header
     * 
     * @param string $content = NULL
     * 
     * @return self
     */
    public function header(String $content = NULL)
    {
        $this->li[] = '<li class="dropdown-header">' . $content . '</li>';

        return $this;
    }

    /**
     * Li
     * 
     * @param string $content = NULL
     * @param string $url     = NULL
     * @param array  $attr    = NULL
     * 
     * @return self
     */
    public function li(String $content = NULL, String $url = NULL, Array $attr = [])
    {
        if( strstr($url, CURRENT_CFURI) )
        {
            $active = ' class="active"';
        }

        $this->li[] ='<li'.($active ?? NULL).'>' . Html::attr($attr)->anchor($url, $content) . '</li>';

        return $this;
    }

    /**
     * Generate Dropdown
     * 
     * @param string   $value
     * @param callable $dropdowns
     * 
     * @return string
     */
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
