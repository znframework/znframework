<?php namespace ZN\Database\Test;

class PersonsGrandModel extends \GrandModel
{
    const table  = 'persons';
    const facade = 'ZN\Database\Test\Persons';
    const connection = 
    [
        'driver'   => 'sqlite',
        'database' => 'UnitTests/package-database/testdb',
        'password' => '1234'
    ];
}