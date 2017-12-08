<?php namespace Project\Controllers;

class Starter extends Controller
{
    public function main(String $params = NULL)
    {
        // Simplicity is our choice, how about yours ?

        Masterpage::title(ucfirst(CURRENT_PROJECT . ' &raquo; ' . CURRENT_CONTROLLER))
                  ->headPage('sections/head')
                  ->bodyPage('sections/body');
    }
}