<?php namespace ZN\Generator;

use Config;

class GeneratorExtends extends \ZN\Test\GlobalExtends
{
    public function __construct()
    {
        parent::__construct();

        Config::database('database', 
        [
            'driver'   => 'sqlite',
            'database' => self::default . 'package-database/testdb',
            'password' => '1234'
        ]);
    }
}