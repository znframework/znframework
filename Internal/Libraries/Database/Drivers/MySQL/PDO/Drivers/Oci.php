<?php
namespace ZN\Database\Drivers\MySQL\PDO\Drivers;

use ZN\Database\Drivers\MySQL\PDO\DriverInterface;
use ZN\Database\Drivers\MySQL\PDO\DriverTrait;

class PDOOciDriver implements DriverInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	use DriverTrait;
	
	/******************************************************************************************
	* DNS       		                                                                      *
	*******************************************************************************************
	| Bu sürücü için dsn bilgisi oluşturuluyor.  							                  |
	******************************************************************************************/
	public function dsn()
	{
		$dsn  = 'oci:';
			
		$dsn .= ( ! empty($this->config['host']) ) 
				? 'dbname=//'.$this->config['host']
				: '';
				
		$dsn .= ( ! empty($this->config['database']) ) 
				? 'dbname='.$this->config['database']
				: '';
				
		$dsn .= ( ! empty($this->config['port']) ) 
				? ':'.$this->config['port'].';' 
				: ';';
		
		$dsn .= ( ! empty($this->config['charset']) ) 
				? 'charset='.$this->config['charset'] 
				: '';
		
		return rtrim($dsn, ';');
	}	
}