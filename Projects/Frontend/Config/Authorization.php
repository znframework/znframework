<?php return
[
    /*
    |--------------------------------------------------------------------------
    | Permission
    |--------------------------------------------------------------------------
    |
    | Includes configurations for the Permission library.
    | 
    | method : It is used to set which id value will use which method of sending.
    | page   : It is used to set which id value will use which page.
    | process: It is used to set which id value will use which object.
    |
    | Example Usage
    |
    | [
    |     '1' => 'any',
    |     '2' => ['noperm'  => ['delete', 'update']],
    |     '3' => ['perm'    => ['delete', 'update']],
    |     '4' => ['noperm'  => ['delete', 'update', 'add']],
    |     '5' => 'all'
    | ]
    |
    */

    'method'  => [],
    'page'    => [],
    'process' => []
];
