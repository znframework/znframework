<?php
class PDOFirebirdDriver
{
	/***********************************************************************************/
	/* PDO FIREBIRD DRIVER LIBRARY		     	                   	                   */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: PDOFirebirdDriver
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