<?php namespace Project\Controllers;

class Home extends Controller
{
    public function main(String $params = NULL)
    {  
        View::pageTitle('ZN')
            ->pageSubtitle('"Simplicity is the ultimate sophistication" - Da Vinci');
    }
}