<?php namespace Project\Controllers;

class Home extends Controller
{
    public function main(String $params = NULL)
    {
        // Simplicity is our choice, how about yours ?

        View::title('ZN5 ORIGINAL')->subtitle('Community Edition');
    }
}
