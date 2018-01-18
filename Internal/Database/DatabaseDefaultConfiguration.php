<?php namespace ZN\Database;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

/**
 * Default Cookie Configuration
 * 
 * Enabled when the configuration file can not be accessed.
 */
class DatabaseDefaultConfiguration
{
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

    public $driver      = 'mysqli';
    public $host        = 'localhost';
    public $database    = 'test';
    public $user        = 'root';
    public $password    = '6340hayal';
    public $dsn         = '';
    public $server      = '';
    public $port        = '';
    public $cacheDriver = 'file';
    public $queryLog    = false;
    public $pconnect    = false;
    public $encode      = false;
    public $prefix      = '';
    public $charset     = 'utf8';
    public $collation   = 'utf8_general_ci';
    public $differentConnection = [];
}
