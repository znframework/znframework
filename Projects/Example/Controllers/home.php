<?php namespace Project\Controllers;

class Home extends Controller
{
    public function main(String $params = NULL)
    {  
        echo 'Hello World';
    }

    public function show404()
    {
        echo '404!';
    }
}