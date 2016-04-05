<?php
class PDOPgsqlDriver implements Pdo\SubDriverInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
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
		$dsn  = 'pgsql:host=';
			
		$dsn .= ( empty($this->config['host']) ) 
				? '127.0.0.1' 
				: $this->config['host'];
		
		$dsn .= ( ! empty($this->config['database']) ) 
				? ';dbname='.$this->config['database'] 
				: '';
				
		$dsn .= ( ! empty($this->config['port']) ) 
				? ';port='.$this->config['port'] 
				: '';
				
		$dsn .= ( ! empty($this->config['user']) ) 
				? ';username='.$this->config['user'] 
				: '';
				
		$dsn .= ( ! empty($this->config['password']) ) 
				? ';password='.$this->config['password'] 
				: '';
	
		return $dsn;
	}	
}