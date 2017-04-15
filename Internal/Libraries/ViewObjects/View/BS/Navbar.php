<?php namespace ZN\ViewObjects\View\BS;

use Buffer, URI;

class Navbar implements NavbarInterface
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
    // Tab
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $tabName
    // @param string $content
    //
    //--------------------------------------------------------------------------------------------------------
    public function link(String $url = NULL, String $value = NULL)
    {
        echo HT . '<li'.( CURRENT_CFURI === strtolower($url) ? ' class="active"' : NULL ).'><a href="'. siteUrl($url) . '">'.$value.'</a></li>' . EOL;
    }

    //--------------------------------------------------------------------------------------------------------
    // Navbar
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string   $siteName
    // @param callable $callback
    //
    //--------------------------------------------------------------------------------------------------------
    public function navbar(String $siteName = NULL, Callable $callback) : String
    {
        $return  = '<nav class="navbar navbar-'.(Properties::$type ?? 'default').'">' . EOL;
        $return .= '<div class="container-'.(Properties::$container ?? 'fluid').'">';
        if( ! empty($siteName) )
        {
            $return .= '<div class="navbar-header">';
            $return .= '<a class="navbar-brand" href="'.siteUrl().'">'.$siteName.'</a>';
            $return .= '</div>';
        }
        $return .= '<ul class="nav navbar-nav">';
        $return .= Buffer::callback($callback, [$this]);
        $return .= '</ul>' . EOL;
        $return .= '</div>' . EOL;
        $return .= '</nav>';

        $this->_default();

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Default
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _default()
    {
        Properties::$type      = NULL;
        Properties::$container = NULL;
    }
}
