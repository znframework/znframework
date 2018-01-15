<?php namespace Project\Controllers;

class Products extends Controller
{
    public function main(String $params = NULL)
    {
        View::title('Products')->description('Products Description');
    }
}
