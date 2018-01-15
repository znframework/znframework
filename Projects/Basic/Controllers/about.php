<?php namespace Project\Controllers;

class About extends Controller
{
    public function main(String $params = NULL)
    {
        View::title('About')->description('About Description');
    }
}
