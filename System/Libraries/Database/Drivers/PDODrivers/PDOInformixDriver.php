<?php
class PDOInformixDriver
{
	/***********************************************************************************/
	/* PDO INFORMIX DRIVER LIBRARY   			                   	                   */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: PDOInformixDriver
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: PDO sürücüsü tarafından kullanılmaktadır.
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
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