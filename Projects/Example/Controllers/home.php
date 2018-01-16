<?php namespace Project\Controllers;

class Home extends Controller
{
    public function main(String $params = NULL)
    {  
        \Cache::driver('memcache')->insert('b', 2);

        echo \Cache::driver('memcache')->select('b');
    }  
}