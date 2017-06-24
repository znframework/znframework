<?php namespace Project\Controllers;

class Home extends Controller
{
    public function main(String $params = NULL)
    {
        // Simplicity is our choice, how about yours ?

        $this->view->title    = 'ZN5 ORIGINAL';
        $this->view->subtitle = 'Community Edition';
    }
}
