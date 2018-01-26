<?php namespace Project\Controllers;

class Initialize extends Controller
{
    public function main(String $params = NULL)
    {
        # The theme is activated.
        # Location: Resources/Themes/Default/
        Theme::active('Default');
        
        # The current settings are being configured.
        Masterpage::title(ucfirst(CURRENT_CONTROLLER))
                  ->headPage('Sections/head')
                  ->bodyPage('Sections/body');
    }
}