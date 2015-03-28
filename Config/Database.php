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
// Örnek: mysql / mysqli;
$config['Database']['driver'] 		= 'mysql'; // String

/* HOST */
// İşlev:Mysql bağlantısı sağlanacak sunudu adını belirlemek için kullanılır.
// Parametre:Metinsel türde sunucu adı girilir.
// Örnek: 'localhost';
$config['Database']['host'] 		= 'localhost'; // String

/* USER */
// İşlev:Mysql kullanıcı adını belirlemek için kullanılır.
// Parametre:Metinsel türde mysql'de oluşturulan kullanıcı adı bilgisi girilir.
// Örnek: 'root';
$config['Database']['user'] 		= 'root'; // String

/* PASSWORD */
// İşlev:Mysql kullanıcı şifresini belirlemek için kullanılır.
// Parametre:Metinsel türde mysql'de oluşturulan şifre bilgisi girilir.
// Örnek: '';
$config['Database']['password']		= ''; // String

/* DATABASE */
// İşlev:Bağlantı sağlanacak veritabanını belirlemek için kullanılır.
// Parametre:Metinsel türde mysql'de oluşturulan veritabanı bilgisi girilir.
// Örnek: 'test';
$config['Database']['database'] 	= 'test'; // String

/* PREFIX */
// İşlev:Tablolara ön ek belirlemek için kullanılır.
// Parametre:Metinsel türde mysql'de oluşturulan tabloya ön ek bilgisi girilir.
// Örnek: '';
$config['Database']['prefix'] 		= ''; // String

/* CHARSET */
// İşlev:Mysql veritabanı karakter setini belirlemek için kullanılır.
// Parametre:Metinsel türde veritabanı karakter seti bilgisi girilir.
// Örnek: 'utf-8';
$config['Database']['charset'] 		= 'utf-8'; // String

/* COLLATION */
// İşlev:Mysql veritabanı karakter karşılaştırması türünü belirlemek için kullanılır.
// Parametre:Metinsel türde veritabanı karakter karşılaştırma bilgisi girilir.
// Örnek: 'utf8_general_ci';
$config['Database']['collation'] 	= 'utf8_general_ci'; // String
//--------------------------------------------------------------------------------------------------------------------------