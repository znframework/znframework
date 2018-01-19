<?php namespace Project\Controllers;

class Home extends Controller
{
    public function main(String $params = NULL)
    {  
        \ZN\Email\Tests\Email::result();
    } 
}