<?php namespace Project\Controllers;

class Home extends Controller
{
    public function main(String $params = NULL)
    {  
        \ZN\Cache\Tests\Cache::result();
    }
}