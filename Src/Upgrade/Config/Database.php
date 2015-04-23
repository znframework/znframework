<?PHP
/************************************************************/
/*                    DATABASE(VERİTABANI)                  */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

//--------------------------------------------------------------------------------------------------------------------------
SETTINGS
//--------------------------------------------------------------------------------------------------------------------------
1-driver
2-host
3-user
4-password
5-database
6-prefix
7-charset
8-collation
//--------------------------------------------------------------------------------------------------------------------------

/* DRIVER */
// İşlev:Mysql bağlantı türünü belirlemek için kullanılır.
// Parametre:Metinsel türde bağlantı türü girilir.
// Drivers: mysql , mysqli , pdo , odbc , mssql , sqlite , postgre , sqlsrv , sqlite3 , oci8 , ibase , cubrid , fbsql , sybase
// PDO Sub Drivers = 4d , cubrid , dblib , firebird , ibm , informix , mysql , oci , odbc , pgsql , sqlite , sqlsrv
// Pdo Driver Seçili ise alt sürülerini kullanmak için  
// pdo->subdriver. Örnek: pdo->mysql , pdo->dblib
$config['Database']['driver'] 		= 'mysqli'; // String
$config['Database']['host'] 		= 'localhost'; // String
$config['Database']['database'] 	= 'test'; // String
$config['Database']['user'] 		= 'root'; // String
$config['Database']['password']		= ''; // String
$config['Database']['dsn'] 			= ''; // String
$config['Database']['server'] 		= ''; // String
$config['Database']['port'] 		= ''; // String
$config['Database']['appname'] 		= ''; // String
$config['Database']['service'] 		= ''; // String
$config['Database']['protocol'] 	= ''; // String
$config['Database']['role'] 		= ''; // String
$config['Database']['pconnect'] 	= false; // Boolean
$config['Database']['encode'] 		= false; // Boolean
$config['Database']['prefix'] 		= ''; // String
$config['Database']['charset'] 		= 'utf8'; // String
$config['Database']['collation'] 	= 'utf8_general_ci'; // String
$config['Database']['different_connection'] = array(); // String
//--------------------------------------------------------------------------------------------------------------------------