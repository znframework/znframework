<?php
/************************************************************/
/*                        DB COMMON                         */
/************************************************************/
/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
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