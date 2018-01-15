<?php namespace Project\Controllers;

class Faq extends Controller
{
    public function main(String $params = NULL)
    {
        View::title('FAQ')->description('FAQ Description');
    }
}
