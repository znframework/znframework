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

use Html;
use ZN\IndividualStructures\Buffer;

class Tabs extends ComponentsExtends
{
    protected $tabs = [];

    //--------------------------------------------------------------------------------------------------------
    // Tab
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string   $menu
    // @param callable $content
    //
    //--------------------------------------------------------------------------------------------------------
    public function tab(String $menu, Callable $content)
    {
        $content = Buffer\Callback::do($content, [new Html]);

        $this->tabs[$menu] = $content;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Pill
    //--------------------------------------------------------------------------------------------------------
    //
    // @param callable $tab
    //
    //--------------------------------------------------------------------------------------------------------
    public function pill(Callable $tab) : String
    {
        return $this->generate($tab, 'pill');
    }

    //--------------------------------------------------------------------------------------------------------
    // Generate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param callable $tab
    //
    //--------------------------------------------------------------------------------------------------------
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
