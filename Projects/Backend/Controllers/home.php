<?php namespace Project\Controllers;

class Home extends Controller
{
    public function main(String $params = NULL)
    {
        // Simplicity is our choice, how about yours ?

        View::pageTitle('ZN FRAMEWORK')
            ->pageSubtitle('"Simplicity is the ultimate sophistication" - Da Vinci');
    }
}
