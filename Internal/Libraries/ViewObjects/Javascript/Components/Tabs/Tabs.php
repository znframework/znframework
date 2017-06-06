<?php namespace ZN\ViewObjects\Javascript\Components;

use Html, Buffer;

class Tabs extends ComponentsExtends implements TabsInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

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
        $content = Buffer::function($content, [new Html]);

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

        $attr['autoloadExtensions'] = $this->autoloadExtensions ?? false;
        $attr['extensions']         = $this->extensions         ?? [];
        $attr['tabs']               = $this->tabs;
        $attr['type']               = $type;

        $this->defaultVariables();

        return $this->load('Tabs/View', $attr);
    }
}
