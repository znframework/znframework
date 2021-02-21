<?php return
[
    /*
    |--------------------------------------------------------------------------
    | Migration
    |--------------------------------------------------------------------------
    |
    | The table where the migration information will be saved.
    |
    */

    'migration' =>
    [
        'table' => 'migrations'
    ],

    /*
    |--------------------------------------------------------------------------
    | Database
    |--------------------------------------------------------------------------
    |
    | Database connection settings are made.
    |
    | driver     : The database platform to be used is set. 
    |              Options: mysqli, oracle, postgres, sqlite, sqlserver, odbc
    | host       : Database server address.
    | database   : Sets the database name.
    | user       : Sets the database user name.
    | password   : Sets the database user password.
    | port       : Sets the port.
    |              Using Database: Postgres, SQLServer, PDO:MySQL
    | dns        : DSN connection settings.
    |              Using Database: Oracle, ODBC, Postgres, PDO
    | server     : Sets the server.
    |              Using Database: ODBC, SQLServer
    | ssl        : SSL connection.
    |              Using Database: PDO, MySQLi          
    | cacheDriver: Sets the cache driver.
    |              Options: get, apcu, apc, memcache, wincache, file, redis
    | queryLog   : Sets the loging of queries.
    | pconnect   : Sets the persistent connection status. 
    |              Using Database: Oracle, ODBC, Postgres, SQLite
    | encode     : It only uses the SQLServer driver.
    | prefix     : Defines a prefix for prefixed tables.
    | charset    : Character encoding of constructions.
    | collation  : Character group definition.
    |              Using Database: MySQLi, PDO:MySQL
    | differentConnection: It creates different connections at the same time. 
    |                      Used with DB/Forge/Tool::differentConnection() method.                  
    |                      ['x' => ['driver' => 'postgres', ...], ...]
    |
    */

    'database' =>
    [
        'driver'      => 'mysqli',
        'host'        => 'localhost',
        'database'    => 'test',
        'user'        => 'root',
        'password'    => '',
        'port'        => '',
        'dsn'         => '',
        'server'      => '',
        'ssl'         => 
        [
            'key'     => NULL, 
            'cert'    => NULL, 
            'ca'      => NULL,
            'capath'  => NULL,
            'cipher'  => NULL
        ],
        'cacheDriver' => 'file',
        'queryLog'    => false,
        'pconnect'    => false,
        'encode'      => false,
        'prefix'      => '',
        'charset'     => 'utf8',
        'collation'   => 'utf8_general_ci',
        'differentConnection' => []
    ],

    /*
    |--------------------------------------------------------------------------
    | MongoDB
    |--------------------------------------------------------------------------
    |
    | database      : Database name.
    | dns           : DSN connection settings.
    | options       : URI options.
    | driverOptions : Driver options. 
    */

    'mongodb' =>
    [
        'database'      => 'test',
        'dns'           => 'localhost',
        'options'       => [],
        'driverOptions' => []
    ]
];