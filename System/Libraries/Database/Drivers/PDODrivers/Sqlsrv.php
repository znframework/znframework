<?php
/************************************************************/
/*                PDO SQLSRV DRIVER LIBRARY                 */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* PDO SQLSRV DRIVER		     	                                                          *
*******************************************************************************************
| Dahil(Import) Edilirken : Dahil Edilemez.  							                  |
| Sınıfı Kullanırken      :	Kullanılamaz.												  |
| 																						  |
| NOT: Veritabanı kütüphaneler için oluşturulmuş yardımcı sınıftır.                       |
******************************************************************************************/
class PDOSqlsrvDriver
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
		$this->config = Config::get('Database');	
	}
	
	/******************************************************************************************
	* DNS       		                                                                      *
	*******************************************************************************************
	| Bu sürücü için dsn bilgisi oluşturuluyor.  							                  |
	******************************************************************************************/
	public function dsn()
	{
		$dsn  = '';
		
		$dsn  = 'sqlsrv:Server=';
			if( ! empty($this->config['server']) ) 
			{
				$dsn .= $this->config['server'];
			}
			elseif( ! empty($this->config['host']) ) 
			{
				$dsn .= $this->config['server'];
			}
			else 
			{
				$dsn .= '127.0.0.1';
			}
			
			$dsn .= ( ! empty($this->config['port']) ) 
					? ','.$this->config['port'] 
					: '';
			
			$dsn .= ( ! empty($this->config['database'])) 
			        ? ';Database='.$this->config['database'] 
					: '';
	
		return $dsn;
	}	
}