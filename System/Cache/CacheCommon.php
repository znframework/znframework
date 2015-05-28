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
function cachecommon($driver = '')
{	
	$config = config::get('Cache');
	
	if( isset($config['driver']) ) 
	{	
		// Geçerli sürücüler
		$drivers = array
		(
			'Memcache',
			'Wincache',
			'Apc'
		);
		
		
		
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
		
		// Sürücünün geçerliliği kontrol ediliyor. 
		if( ! in_array($driver, $drivers) )
		{
			return false;	
		}
		
		$driver_path = CACHE_DIR.'Drivers/'.$driver.'.php';
		
		// Hangi sürücü kullanılacaksa
		// o sürüyü dahil ediyor.
		if( is_file($driver_path) )	
		{		
			require_once($driver_path);
		}
		else
		{
			die(get_message('Cache', 'cache_driver_error', $driver));
		}
		
		$driver = $driver.'Driver';
		
		// Sürüden bir nesne oluşturuluyor.
		$cache = new $driver;
		
		return $cache;
	}	
}