<?php namespace Project\Controllers;

class Initialize extends Controller
{
    public function main(String $params = NULL)
    {
        // Simplicity is our choice, how about yours ?

        Masterpage::title(ucfirst(CURRENT_CONTROLLER))
                  ->headPage('sections/head')
                  ->bodyPage('sections/body');
    }
}