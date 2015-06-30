<?php
/************************************************************/
/*               PDO INFORMIX DRIVER LIBRARY                */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* PDO INFORMIX DRIVER		     	                                                      *
*******************************************************************************************
| Dahil(Import) Edilirken : Dahil Edilemez.  							                  |
| Sınıfı Kullanırken      :	Kullanılamaz.												  |
| 																						  |
| NOT: Veritabanı kütüphaneler için oluşturulmuş yardımcı sınıftır.                       |
******************************************************************************************/
class PDOInformixDriver
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
		
		$dsn  = 'informix:host='.
			
		$dsn .= ( empty($this->config['host']) ) 	
				? '127.0.0.1' 
				: $this->config['host'];
				
		$dsn .= ( ! empty($this->config['database']) ) 
				? ';database='.$this->config['database'] 
				: '';
				
		$dsn .= ( ! empty($this->config['service']) ) 
				? ';service='.$this->config['service'] 
				: $this->config['port'];
				
		$dsn .= ( ! empty($this->config['server']) ) 
				? ';server='.$this->config['server'] 
				: '';
				
		$dsn .= ( ! empty($this->config['protocol']) ) 
				? ';protocol='.$this->config['server'] 
				: 'onsoctcp';

		$dsn .= ';EnableScrollableCursors=1';
		
		return $dsn;
	}	
}