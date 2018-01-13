<?php return
[
    /*
    |--------------------------------------------------------------------------
    | Migration
    |--------------------------------------------------------------------------
    |
    | The table on which migratory records are kept is set.
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
    |              Options: mysqli, pdo(Only MySQL), oracle, postgres, sqlite, 
    |              sqlserver, odbc
    | host       : Database server address.
    | database   : Sets the database name.
    | user       : Sets the database user name.
    | password   : Sets the database user password.
    | dns        : DSN connection settings.
    |              Using Database: Oracle, ODBC, Postgres, PDO
    | server     : Sets the server.
    |              Using Database: ODBC, SQLServer
    | port       : Sets the port.
    |              Using Database: Postgres, SQLServer, PDO:MySQL
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
        'password'    => '6340hayal',
        'dsn'         => '',
        'server'      => '',
        'port'        => '',
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
    | Datagrid
    |--------------------------------------------------------------------------
    |
    | Includes default settings for the datagrids.
    |
    */

    'grid' =>
    [
        'buttonNames' =>
        [
            'add'           => ($lang = Lang::select('Database'))['addButton'],
            'edit'          => $lang['editButton'],
            'update'        => $lang['updateButton'],
            'save'          => $lang['saveButton'],
            'close'         => $lang['closeButton'],
            'delete'        => $lang['deleteButton'],
            'deleteSelected'=> $lang['deleteSelectedName'],
            'deleteAll'     => $lang['deleteAllName']
        ],
        'placeHolders' =>
        [
            'search' => $lang['searchHolder'],
            'inputs' => $lang['inputsHolder'],
        ],
        'styleElement' =>
        [
            '#DBGRID_TABLE tr:nth-child(even)' => ['background' => '#E6F9FF'],
            '#DBGRID_TABLE tr:nth-child(odd)'  => ['background' => '#FFF']
        ],
        'attributes'   =>
        [
            'table'         => ['width' => '100%', 'cellspacing' => 0, 'cellpadding' => 10, 'style' => 'margin-top:15px; margin-bottom:15px; border:solid 1px #ddd; font-family:Arial; color:#888; font-size:14px;'],
            'editTables'    => ['style' => 'font-family:Arial; color:#888; font-size:14px;'],
            'columns'       => ['height' => 75, 'style' => 'text-decoration:none; color:#0085B2'],
            'search'        => ['style' => 'height:34px; color:#0085B2; border:solid 1px #0085B2; text-indent:10px'],
            'add'           => ['style' => $style = 'height:34px; color:#0085B2; background:none; border:solid 1px #0085B2; cursor:pointer'],
            'deleteSelected'=> ['style' => $style],
            'deleteAll'     => ['style' => $style],
            'save'          => ['style' => $style],
            'update'        => ['style' => $style],
            'delete'        => ['style' => $style],
            'edit'          => ['style' => $style],
            'listTables'    => [],
            'inputs'        =>
            [
                'text'      => ['style' => 'height:34px; color:#0085B2; border:solid 1px #0085B2; text-indent:10px'],
                'textarea'  => ['style' => 'height:120px; width:290px; color:#0085B2; border:solid 1px #0085B2; text-indent:10px'],
                'radio'     => [],
                'checkbox'  => [],
                'select'    => []
            ]
        ],
        'pagination' =>
        [
            'style' =>
            [
                'links'   => 'color:#0085B2;width:30px; height:30px;text-align:center;padding-top:4px;display:inline-block;background:white;border:solid 1px #ddd;border-radius: 4px;-webkit-border-radius: 4px;-moz-border-radius: 4px;text-decoration:none;',
                'current' => 'font-weight:bold;'
            ]
        ]
    ]
];