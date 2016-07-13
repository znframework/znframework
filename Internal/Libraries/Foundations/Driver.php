<?php
namespace ZN\Foundations;

class InternalDriver
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
		if( is_array($library) )
		{
			$config  = \Config::get(key($library), current($library));
		}
		else
		{
			$config  = \Config::get($library);
		}
		
		$driver  = ! empty($driver)
				   ? $driver
				   : $config['driver'];
	
		if( ! empty($driver) ) 
		{	
			$drv = ucwords($driver).'Driver';
			
			return uselib($drv);
		}	
		else
		{
			die(getErrorMessage('Error', 'driverError', $driver));	
		}
	}
}