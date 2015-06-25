<?PHP
/************************************************************/
/*                    DATABASE(VERİTABANI)                  */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* DATABASE                                                                         	  	  *
*******************************************************************************************
| Genel Kullanım: Veritabanı kütüphanesi ile ilgili ayarları yapmak için kullanılır.      |
******************************************************************************************/

/******************************************************************************************
* DRIVER                                                                           	      *
*******************************************************************************************
| Genel Kullanım: // İşlev:Mysql bağlantı türünü belirlemek için kullanılır.		   	  |
| Parametre:Metinsel türde bağlantı türü girilir.										  |
| Drivers: mysql , mysqli , pdo , odbc , mssql , sqlite , postgre , sqlsrv , sqlite3 , 	  |	
| oci8 , ibase , cubrid , fbsql , sybase												  |				
| PDO Sub Drivers = 4d , cubrid , dblib , firebird , ibm , informix , mysql , oci , 	  |
| odbc , pgsql , sqlite , sqlsrv														  |
| Pdo Driver Seçili ise alt sürülerini kullanmak için  									  |
| pdo->subdriver. Örnek: pdo->mysql , pdo->dblib			 							  |						
******************************************************************************************/
$config['Database']['driver'] 		= 'mysqli';

/******************************************************************************************
* HOST                                                                           	      *
*******************************************************************************************
| Genel Kullanım: Database için host seçimidir. Varsayılan:localhost 					  |					
******************************************************************************************/
$config['Database']['host'] 		= 'localhost'; 

/******************************************************************************************
* DATABASE                                                                           	  *
*******************************************************************************************
| Genel Kullanım: Database ismi. Varsayılan:test 										  |					
******************************************************************************************/
$config['Database']['database'] 	= 'test';

/******************************************************************************************
* USER                                                                               	  *
*******************************************************************************************
| Genel Kullanım: Database kullanıcı ismi. Varsayılan:root 								  |					
******************************************************************************************/
$config['Database']['user'] 		= 'root'; 

/******************************************************************************************
* PASSWORD                                                                                *
*******************************************************************************************
| Genel Kullanım: Database kullanıcı şifresi. Varsayılan:empty 							  |					
******************************************************************************************/
$config['Database']['password']		= '';

/******************************************************************************************
* DSN                                                                                     *
*******************************************************************************************
| Genel Kullanım: Özellikle PDO alt sürücüleri için bağlantılar oluşturmak için		      |
| kullanılan bağlantı ayar kümesidir. Varsayılan:empty 							          |
|																						  |
| DNS Kullanan Veritabanları															  |
| 1-OCI8																				  |
| 2-ODBC																				  |
| 3-POSTGRE																				  |
| 4-PDO ve Alt Sürücüleri															      |					
******************************************************************************************/
$config['Database']['dsn'] 			= '';

/******************************************************************************************
* SERVER                                                                                  *
*******************************************************************************************
| Genel Kullanım: Server bağlantısı gerektiren sürücüler için kullanılan ayardır. 		  |
| Varsayılan:empty 							                                              |
|																						  |
| SERVER Kullanan Veritabanları															  |
| 1-MSSQL																				  |
| 2-ODBC																				  |
| 3-SQLSRV																				  |
| 4-SYBASE																				  |
| 5-PDO -> INFORMIX																		  |
| 6-PDO -> SQLSRV															              |					
******************************************************************************************/
$config['Database']['server'] 		= '';

/******************************************************************************************
* PORT                                                                                    *
*******************************************************************************************
| Genel Kullanım: Port bağlantısı gerektiren sürücüler için kullanılan ayardır. 		  |
| Varsayılan:empty 							                                              |
|																						  |
| PORT Kullanan Veritabanları															  |
| 1-CUBRID																				  |
| 2-POSTGRE																				  |
| 3-SQLSRV																				  |
| 4-PDO -> 4D																			  |
| 5-PDO -> CUBRID																		  |
| 6-PDO -> DBLIB															              |	
| 7-PDO -> IBM															                  |	
| 8-PDO -> INFORMIX														                  |		
| 9-PDO -> MYSQL														                  |
| 10-PDO -> OCI														                      |	
| 11-PDO -> ODBC														                  |	
| 12-PDO -> POSTGRE														                  |		
| 13-PDO -> SQLSRV														                  |				
******************************************************************************************/
$config['Database']['port'] 		= '';

/******************************************************************************************
* APPNAME                                                                                 *
*******************************************************************************************
| Genel Kullanım: Uygulama ismi gerektiren sürücüler için kullanılan ayardır. 		      |
| Varsayılan:empty 							                                              |
|																						  |
| APPNAME Kullanan Veritabanları														  |
| 1-SYBASE																				  |
| 2-PDO -> DBLIB																		  |
******************************************************************************************/
$config['Database']['appname'] 		= ''; 

/******************************************************************************************
* SERVICE                                                                                 *
*******************************************************************************************
| Genel Kullanım: Service bilgisi gerektiren sürücüler için kullanılan ayardır. 		  |
| Varsayılan:empty 							                                              |
|																						  |
| SERVICE Kullanan Veritabanları														  |
| 1-PDO -> INFORMIX																		  |
******************************************************************************************/
$config['Database']['service'] 		= '';

/******************************************************************************************
* PROTOCOL                                                                                *
*******************************************************************************************
| Genel Kullanım: Protocol bağlantısı gerektiren sürücüler için kullanılan ayardır. 	  |
| Varsayılan:empty 							                                              |
|																						  |
| PROTOCOL Kullanan Veritabanları													      |
| 1-PDO -> IBM															                  |	
| 2-PDO -> INFORMIX														                  |															                      |	
| 3-PDO -> ODBC														                      |			
******************************************************************************************/
$config['Database']['protocol'] 	= '';

/******************************************************************************************
* ROLE                                                                                    *
*******************************************************************************************
| Genel Kullanım: Role bilgisi gerektiren sürücüler için kullanılan ayardır. 	          |
| Varsayılan:empty 							                                              |
|																						  |
| ROLE Kullanan Veritabanları		    											      |
| 1-PDO -> FIREBIRD															              |			
******************************************************************************************/
$config['Database']['role'] 		= '';

/******************************************************************************************
* PCONNECT                                                                                *
*******************************************************************************************
| Genel Kullanım: Pconnect bağlantısı destekleyen sürücüler için kullanılan ayardır. 	  |
| Varsayılan:false 							                                              |
|																						  |
| PCONNECT Kullanan Veritabanları													      |
| 1-FBSQL															                      |	
| 2-IBASE													                              |															                      |	
| 3-MSSQL													                      		  |			
| 4-MYSQL													                     	      |			
| 5-OCI8													                      		  |			
| 6-ODBC													                      		  |		
| 7-POSTGRE													                      		  |		
| 8-SQLITE													                      		  |	
| 9-SYBASE													                      		  |	
******************************************************************************************/
$config['Database']['pconnect'] 	= false;

/******************************************************************************************
* ENCODE                                                                                  *
*******************************************************************************************
| Genel Kullanım: Encode şifreleme bilgisi gerektiren sürücüler için kullanılan ayardır.  |
| Varsayılan:false 							                                              |
|																						  |
| ENCODE Kullanan Veritabanları		    											      |
| 1-SQLSRV          														              |			
******************************************************************************************/
$config['Database']['encode'] 		= false;

/******************************************************************************************
* PREFIX                                                                                  *
*******************************************************************************************
| Genel Kullanım: Tablo ön eki bilgisi kullanabilen sürücüler için kullanılan ayardır.    |
| Varsayılan:empty 							                                              |
|																						  |
| PREFIX Kullanan Veritabanları		    											      |
| 1-TÜM SÜRÜCÜLER          														          |			
******************************************************************************************/
$config['Database']['prefix'] 		= '';

/******************************************************************************************
* CHARSET                                                                                 *
*******************************************************************************************
| Genel Kullanım: Karakter seti bilgisi kullanabilen sürücüler için kullanılan ayardır.   |
| Varsayılan:utf8 							                                              |
|																						  |
| CHARSET Kullanan Veritabanları		    											  |
| 1-TÜM SÜRÜCÜLER      														              |			
******************************************************************************************/
$config['Database']['charset'] 		= 'utf8'; 

/******************************************************************************************
* COLLATION                                                                               *
*******************************************************************************************
| Genel Kullanım: Karakter grubu bilgisi kullanabilen sürücüler için kullanılan ayardır.  |
| Varsayılan:utf8_general_ci				                                              |
|																						  |
| COLLATION Kullanan Veritabanları		    											  |
| 1-MYSQL      														              		  |		
| 2-MYSQLI     														              		  |	
| 1-PDO -> MYSQL      	    										              		  |		
******************************************************************************************/
$config['Database']['collation'] 	= 'utf8_general_ci'; // String

/******************************************************************************************
* DIFFERENT CONNECTION                                                                    *
*******************************************************************************************
| Genel Kullanım: Farklı veya birden fazla veritabanı bağlantısı oluşturumak için		  |
| kullanılmaktadır. Bu ayar sayesinden aynı anda çoklu bağlantı sağlamış olacaksınız.     |
|																						  |
| Örnek Kullanım		    											  				  | 		
| array																				      |
| (																						  |
|     'ornek1VT' => array('database' => 'ornek1'),									      |
|	  'ornek2VT' => array('database' => 'ornek2')										  |
| )     	    										              		  			  |		
******************************************************************************************/
$config['Database']['differentConnection'] = array(); // String