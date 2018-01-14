<?php namespace Project\Controllers;

class Home extends Controller
{
    public function main(String $params = NULL)
    {  
        #\lang::set('tr');
        
        echo \lang::get();
    }
}