<?php namespace Project\Controllers;

class Home extends Controller
{
    /**
     * Home::main
     * 
     * Loads opening page.
     * Location: Views/Home/main.wizard.php
     */
    public function main(String $params = NULL)
    {  
        # Sending data to the view page.
        View::pageTitle('ZN')->pageSubtitle('"Simplicity is the ultimate sophistication" - Da Vinci');
    } 

    /**
     * Home::s404
     * 
     * Loads show 404 page.
     * Location: Views/Home/s404.wizard.php
     */
    public function s404()
    {
        # Sets masterpage title.
        Masterpage::title($title = '404');

        # Sending data to the view page.
        View::pageTitle($title)->pageSubtitle('The page you searched for was not found!');
    }
}