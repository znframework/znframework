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
function cacheCommon($driver = '')
{	
	$config = Config::get('Cache');
	
	if( isset($config['driver']) ) 
	{	
		// Geçerli sürücüler
		$drivers = Folder::files(SYSTEM_LIBRARIES_DIR.'Cache/Drivers/', 'php');	
		
		if( empty($driver) )
		{
			// Drirver ayarına girilen verinin
			// ilk harfini büyük yapması isteniyor.
			// memcache => Memcache		
			$driver = ucwords($config['driver']);
		}
		else
		{
			$driver = ucwords($driver);	
		}
		
		$drv = $driver.'Driver';
		
		// Sürücünün geçerliliği kontrol ediliyor. 
		if( ! in_array(suffix($drv, '.php'), $drivers) )
		{
			return false;	
		}
		
		// Sürüden bir nesne oluşturuluyor.
		$cache = new $drv;
		
		return $cache;
	}	
}