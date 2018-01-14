<?php namespace ZN\JavascriptComponents\Tabs;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use Html;
use ZN\Buffering;
use ZN\JavascriptComponents\ComponentsExtends;

class Build extends ComponentsExtends
{
    /**
     * Keeps tabs
     * 
     * @var array
     */
    protected $tabs = [];

    /**
     * Tab
     * 
     * @param string   $menu
     * @param callable $content
     * 
     * @return self
     */
    public function tab(String $menu, Callable $content)
    {
        $content = Buffering\Callback::do($content, [new Html]);

        $this->tabs[$menu] = $content;

        return $this;
    }

    /**
     * Generate Pill
     * 
     * @param callable $tab
     * 
     * @return string
     */
    public function pill(Callable $tab) : String
    {
        return $this->generate($tab, 'pill');
    }

    /**
     * Generate Tabs
     * 
     * @param callable $tab
     * @param string   $type = 'tab'
     * 
     * @return string
     */
    public function generate(Callable $tab, $type = 'tab') : String
    {
        $tab($this);

        return $this->prop
        ([
            'tabs' => $this->tabs,
            'type' => $type
        ]);
    }
}
