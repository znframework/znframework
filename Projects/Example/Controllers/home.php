<?php namespace Project\Controllers;

class Home extends Controller
{
    public function main(String $params = NULL)
    {  
        \ZN\Captcha\Tests\Captcha::result();
    }
}