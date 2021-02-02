<?php namespace ZN\Authorization;

use Config;

class AuthorizationExtends extends \ZN\Test\GlobalExtends
{
    public function __construct()
    {
        parent::__construct();

        Config::set('Auth', 
        [
            'method'  => 
            [
                1 => 'all',
                2 => ['noperm' => ['delete']],
                3 => ['noperm' => ['update', 'delete']],
                4 => 'any'
            ],
            'page'    => 
            [
                1 => 'all',
                2 => ['noperm' => ['delete']],
                3 => ['noperm' => ['update', 'delete']],
                4 => 'any'
            ],
            'process' => 
            [
                1 => 'all',
                2 => ['noperm' => ['delete']],
                3 => ['noperm' => ['update', 'delete']],
                4 => 'any'
            ]
        ]);
    }
}