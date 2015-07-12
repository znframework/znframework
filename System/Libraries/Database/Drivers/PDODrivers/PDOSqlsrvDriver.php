<?php
class PDOSqlsrvDriver
{
	/***********************************************************************************/
	/* PDO SQLSRV DRIVER LIBRARY     			                   	                   */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: PDOSqlsrvDriver
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