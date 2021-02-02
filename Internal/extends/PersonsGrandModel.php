<?php namespace ZN\Database;

class PersonsGrandModel extends GrandModel
{
    const table  = 'persons';
    const facade = 'ZN\Database\Test\Persons';
    const connection = 
    [
        'driver'   => 'sqlite',
        'database' => \ZN\Test\GlobalExtends::default . 'package-database/testdb',
        'password' => '1234'
    ];
}