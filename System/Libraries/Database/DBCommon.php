<?php
/************************************************************/
/*                        DB COMMON                         */
/************************************************************/
/* Yazar: Ozan UYKUN
/* Site: www.zntr.net
/* Lisans: The MIT License
/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
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
			$subDrivers = explode('->', $driver);
			$driver  = $subDrivers[0];
		}
		
		$drv = $driver.'Driver';
		
		// Sürüden bir nesne oluşturuluyor.
		$db = new $drv;
		
		return $db;
	}	
}