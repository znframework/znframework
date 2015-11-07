<?php
trait DBCommonTrait
{
	/* Config Değişkeni
	 *  
	 * Tablo ayar bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $config;
	
	/* Prefix Değişkeni
	 *  
	 * Tablo ön eki bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $prefix;
	
	/* Table Değişkeni
	 *  
	 * TABLE bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $table;
	
	/* Table Name Değişkeni
	 *  
	 * Sorguda kullanılan tablo bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $tableName;
	
	/******************************************************************************************
	* CONSTRUCT                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Nesne tanımlaması ve veritabanı ayarları çalıştırılıyor.				  |
	|          																				  |
	******************************************************************************************/
	public function __construct($config = array())
	{
		$this->db = $this->run();

		$this->prefix = $this->config['prefix'];
			
		if( empty($config) ) 
		{
			$config = $this->config;
		}
		
		$this->db->connect($config);
	}
	
	/******************************************************************************************
	* RUN                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürüleri için ortak bir kullanım oluşturulmuştur.    		  |
	| başında kullanılır.										  							  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	******************************************************************************************/
	private function run()
	{	
		$config = Config::get('Database');
		
		$this->config = $config;
		
		if( isset($config['driver']) ) 
		{	
			// Drivere ayarına girilen verinin
			// ilk harfini büyük yapması isteniyor.
			// pdo => Pdo		
			$driver = ucfirst($config['driver']);
		
			// Sub driver kullanılırken driver->subdriver
			// kullanımı için böyle bir kontrol yapılmaktadır.
			if( strpos($driver, '->') )
			{
				$subDrivers = explode('->', $driver);
				$driver  = $subDrivers[0];
			}
			
			$drv = $driver.'Driver';
			
			// Sürüden bir nesne oluşturuluyor.
			$db = new $drv;
			
			return $db;
		}	
	}
	
	/******************************************************************************************
	* TABLE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde Tablo ismi belirtmek için oluşturulmuştur.			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @table => Tablo adı parametresidir.                                       |
	|          																				  |
	| Örnek Kullanım: ->table('OrnekTablo')		        									  |
	|          																				  |
	******************************************************************************************/
	public function table($table = '')
	{
		if( ! is_string($table) ) 
		{
			Error::set(lang('Error', 'stringParameter', 'table'));
		}
		else
		{
			$this->table = ' '.$this->prefix.$table.' ';
			$this->tableName = $this->prefix.$table;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* DIFFERENT CONNECTION                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Birden fazla ve birden farklı veritabanı bağlantısı yapmak içindir.	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @connect_name => Bağlantı veri dizisi ismi.       	                      |
	|          																				  |
	| >>>>>>>>>>>>>>>>>>>>>>>>>>>Detaylı kullanım için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<<<  	  |
	|          																				  |
	******************************************************************************************/
	public function differentConnection($connectName = '')
	{
		if( ! is_string($connectName) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'connectName'));
		}
		
		$config = $this->config;
		$configDifferent = $config['differentConnection'];
		
		if( ! isset($configDifferent[$connectName]) ) 
		{
			return Error::set(lang('Error', 'emptyParameter', 'connectName'));
		}
		
		foreach($config as $key => $val)
		{
			if( $key !== 'differentConnection' )
			{
				if( ! isset($configDifferent[$connectName][$key]) )
				{
					$configDifferent[$connectName][$key] = $val;
				}
			}
		}
		
		return new self($configDifferent[$connectName]);
	}
	
	/******************************************************************************************
	* MATH                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: SELECT FUNC()											 				  |
	
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	private function _math($type, $args = array())
	{
		$args = rtrim(implode(',', $args), ',');
		
		return " $type($args) ";
	}
	
	/******************************************************************************************
	* ERROR                                                                                   *
	******************************************************************************************/
	public function error()
	{
		Error::set($this->db->error()); 
		return $this->db->error(); 
	}
	
	/******************************************************************************************
	* CLOSE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı bağlantısını kapatmak için kullanılır.	      			      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->close();                     			                              |
	|          																				  |
	******************************************************************************************/
	public function close()
	{ 
		return $this->db->close(); 
	}
	
	/******************************************************************************************
	* VERSION                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücüsünün sürüm bilgisini verir.							  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: $this->db->version();  									 			  |
	|          																				  |
	******************************************************************************************/
	public function version()
	{
		return $this->db->version();	
	}
	
	/******************************************************************************************
	* DESTRUCT                                                                                *
	******************************************************************************************/
	public function __destruct()
	{
		@$this->db->close();	
	}
}