<?php
/************************************************************/
/*                        DB COMMON                         */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

/******************************************************************************************
* DB COMMON                                                                               *
*******************************************************************************************
| Genel Kullanım: Veritabanı sürüleri için ortak bir kullanım oluşturulmuştur.    		  |
| başında kullanılır.										  							  |
|															                              |
| Parametreler: Herhangi bir parametresi yoktur.                                          |
|          																				  |
******************************************************************************************/
function dbcommon()
{	
	$config = config::get('Database');
	
	if( isset($config['driver']) ) 
	{	
		// Drivere ayarına girilen verinin
		// ilk harfini büyük yapması isteniyor.
		// pdo => Pdo		
		$driver = ucwords($config['driver']);
		
		// Sub driver kullanılırken driver->subdriver
		// kullanımı için böyle bir kontrol yapılmaktadır.
		if( strpos($config['driver'], '->') )
		{
			$subdrivers = explode('->', $config['driver']);
			$driver  = $subdrivers[0];
		}
		
		$driver_path = SYSTEM_LIBRARIES_DIR.'Database/Drivers/'.$driver.'.php';
		
		// Hangi sürücü kullanılacaksa
		// o sürüyü dahil ediyor.
		if( is_file($driver_path) )	
		{		
			require_once($driver_path);
		}
		else
		{
			die(get_message('Database', 'db_driver_error', $driver));
		}
		
		$driver = $driver.'Driver';
		
		// Sürüden bir nesne oluşturuluyor.
		$db = new $driver;
		
		return $db;
	}	
}