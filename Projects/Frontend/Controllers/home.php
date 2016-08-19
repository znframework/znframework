<?php namespace Project\Controllers;

use Import;

class Home extends Controller
{
    public function main(String $params = NULL)
    {
        Import::view('welcome.wizard');
    }
}