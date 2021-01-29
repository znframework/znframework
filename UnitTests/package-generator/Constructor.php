<?php namespace ZN\Generator\Test;

use Config;

class Constructor extends \PHPUnit\Framework\TestCase
{
    public function __construct()
    {
        parent::__construct();

        Config::database('database', 
        [
            'driver'   => 'sqlite',
            'database' => 'UnitTests/package-generator/resources/testdb',
            'password' => '1234'
        ]);
    }
}