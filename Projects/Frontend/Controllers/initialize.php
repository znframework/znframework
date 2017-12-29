<?php namespace Project\Controllers;

class Initialize extends Controller
{
    public function main(String $params = NULL)
    {
        Theme::active('Default');
        
        Masterpage::title(ucfirst(CURRENT_CONTROLLER))
                  ->headPage('sections/head')
                  ->bodyPage('sections/body');
    }
}