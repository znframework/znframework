<?php
class PDOSqlsrvDriver implements Pdo\SubDriverInterface
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