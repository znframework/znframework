<?php
class __USE_STATIC_ACCESS__Driver
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/******************************************************************************************
	* RUN                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Kütüphane sürüleri için ortak bir kullanım oluşturulmuştur.    		  |
	  başında kullanılır.										  							  
	  
	  @param  string $driver
	  @param  string $library
	  @return object
	|          																				  |
	******************************************************************************************/
	public function run($library = '', $driver = '')
	{	
		$config  = Config::get(ucwords(strtolower($library)));
		
		$driver  = ! empty($driver)
				   ? $driver
				   : $config['driver'];
	
		if( ! empty($driver) ) 
		{	
			$drv = ucwords($driver).'Driver';
			
			$var = new $drv;
			
			return $var;
		}	
		else
		{
			die(getErrorMessage('Error', 'driverError', $driver));	
		}
	}
}