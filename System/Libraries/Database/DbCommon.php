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
function DBCommon()
{	
	$config = Config::get('Database');
	
	if( isset($config['driver']) ) 
	{	
		// Drivere ayarına girilen verinin
		// ilk harfini büyük yapması isteniyor.
		// pdo => Pdo		
		$driver = ucfirst($config['driver']);
	
		// Sub driver kullanılırken driver->subdriver
		// kullanımı için böyle bir kontrol yapılmaktadır.
		if( strpos($driver, '->') )
		{
			$subdrivers = explode('->', $driver);
			$driver  = $subdrivers[0];
		}
		
		$drv = $driver.'Driver';
		
		$driver_path = SYSTEM_LIBRARIES_DIR.'Database/Drivers/'.$drv.'.php';
		
		// Hangi sürücü kullanılacaksa
		// o sürüyü dahil ediyor.
		if( ! is_file($driver_path) )	
		{		
			die(getMessage('Database', 'driverError', $driver));
		}
		else
		{
			require_once($driver_path);	
		}
		
		// Sürüden bir nesne oluşturuluyor.
		$db = new $drv;
		
		return $db;
	}	
}