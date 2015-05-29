<?php
/************************************************************/
/*                PDO FIREBIRD DRIVER LIBRARY               */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* PDO FIREBIRD DRIVER		                                                              *
*******************************************************************************************
| Dahil(Import) Edilirken : Dahil Edilemez.  							                  |
| Sınıfı Kullanırken      :	Kullanılamaz.												  |
| 																						  |
| NOT: Veritabanı kütüphaneler için oluşturulmuş yardımcı sınıftır.                       |
******************************************************************************************/
class PDOFirebirdDriver
{
	/* Config Değişkeni
	 *  
	 * Veritabanı ayarlar bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	protected $config;
	
	/******************************************************************************************
	* CONSTRUCT     	                                                                      *
	******************************************************************************************/
	public function __construct()
	{
		$this->config = config::get('Database');	
	}
	
	/******************************************************************************************
	* DNS       		                                                                      *
	*******************************************************************************************
	| Bu sürücü için dsn bilgisi oluşturuluyor.  							                  |
	******************************************************************************************/
	public function dsn()
	{
		$dsn  = '';
		
		$dsn  = 'firebird:'.
			
		$dsn .= ( ! empty($this->config['database']) ) 
				? 'dbname='.$this->config['database'] 
				: 'dbname='.$this->config['host'];
				
		$dsn .= ( ! empty($this->config['charset']) ) 
				? ';charset='.$this->config['charset'] 
				: '';
				
		$dsn .= ( ! empty($this->config['role']) ) 
				? ';role='.$this->config['role'] 
				: '';
		
		return $dsn;
	}	
}