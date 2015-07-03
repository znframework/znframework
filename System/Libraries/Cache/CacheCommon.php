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
	
	$driver = ! empty($driver)
			  ? $driver
			  : $config['driver'];
	
	if( ! empty($driver) ) 
	{	
		$drv = ucwords($driver).'Driver';
		
		$cache = new $drv;
		
		return $cache;
	}	
	else
	{
		die(getErrorMessage('Cache', 'driverError', $driver));	
	}
}