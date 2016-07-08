<?php
namespace ZN\Database;

trait DatabaseTrait
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Call Method
	//----------------------------------------------------------------------------------------------------
	// 
	// __call()
	//
	//----------------------------------------------------------------------------------------------------
	use \CallUndefinedMethodTrait;
	
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
	
	/* Secure Değişkeni
	 *  
	 * Güvenlik işlem bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $secure;
	
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
	
	/* Unlimited String Query Değişkeni
	 *  
	 * Sorgunun metinsel değerini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $stringQuery;
	
	/* Select Functions Değişkeni
	 *  
	 * Select fonksiyonlarını birleştirmek 
	 * için oluşturulmuştur.
	 *
	 */
	private $selectFunctions;
	
	/* Column Değişkeni
	 *  
	 * Colon ve değerini ayarlamak
	 * için oluşturulmuştur.
	 *
	 */
	private $column;
	
	/******************************************************************************************
	* CONSTRUCT                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Nesne tanımlaması ve veritabanı ayarları çalıştırılıyor.				  |
	|          																				  |
	******************************************************************************************/
	public function __construct($config = [])
	{
		$this->db = $this->run();

		$this->prefix = $this->config['prefix'];
			
		if( empty($config) ) 
		{
			$config = $this->config;
		}
		
		$this->db->connect($config);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Run Query
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $query
	//
	//----------------------------------------------------------------------------------------------------
	protected function _runQuery($query)
	{
		return $this->db->query($this->_querySecurity($query), $this->secure);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Run Exec Query
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $query
	//
	//----------------------------------------------------------------------------------------------------
	protected function _runExecQuery($query)
	{
		return $this->db->exec($this->_querySecurity($query), $this->secure);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Variable Types
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  void
	// @return array
	//
	//----------------------------------------------------------------------------------------------------
	public function vartypes()
	{
		return $this->db->vartypes();
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
		$config = \Config::get('Database');
		
		$this->config = $config;
		
		if( isset($config['driver']) ) 
		{		
			$driver = $config['driver'];
		
			// Sub driver kullanılırken driver:subdriver
			// kullanımı için böyle bir kontrol yapılmaktadır.
			if( strpos($driver, ':') )
			{
				$subDrivers = explode(':', $driver);
				$driver     = $subDrivers[0];
			}
			
			$drv = 'ZN\Database\Drivers\\'.$driver.'Driver';
		
			// Sürüden bir nesne oluşturuluyor.
			$db = new $drv;
			
			return $db;
		}	
	}

	//----------------------------------------------------------------------------------------------------
	// Protected Nail Encode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string $data
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	protected function nailEncode($data)
	{
		return str_replace(["'", "\&#39;", "\\&#39;"], "&#39;", $data);	
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
			\Errors::set('Error', 'stringParameter', 'table');
		}
		else
		{
			$this->table = ' '.$this->prefix.$table.' ';
			$this->tableName = $this->prefix.$table;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* COLUMN                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Sütun ve değerini ayarlamak için kullanılır.		                 	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @col => Sütun adı.                    				                      |
	| 1. string var @val => Sütun değeri.	  	 	                                          |
	|          																				  |
	| Örnek Kullanım: ->table('OrnekTablo')		        									  |
	|          																				  |
	******************************************************************************************/
	public function column($col = '', $val = '')
	{
		if( ! is_string($col) ) 
		{
			\Errors::set('Error', 'stringParameter', 'col');
		}
		
		$this->column[$col] = $val;
		
		return $this;
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
	public function stringQuery()
	{
		if( ! empty($this->stringQuery) )
		{
			return $this->stringQuery; 
		}
		
		return false;
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
		$config 		 = $this->config;
		$configDifferent = $config['differentConnection'];
		
		if( is_string($connectName) && isset($configDifferent[$connectName]) ) 
		{
			$connection = $configDifferent[$connectName];
		}
		elseif( is_array($connectName) )
		{
			$connection = $connectName;	
		}
		else
		{
			return \Errors::set('Error', 'emptyParameter', 'connectName');	
		}
		
		foreach($config as $key => $val)
		{
			if( $key !== 'differentConnection' )
			{
				if( ! isset($connection[$key]) )
				{
					$connection[$key] = $val;
				}
			}
		}
		
		return new self($connection);
	}
	
	/******************************************************************************************
	* SECURE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Sorgu işlemlerinde veri güvenliğini sağlaması için oluşturulmuştur.	  |
	|															                              |
	| Parametreler: Tek dizi parametresi vardır.                                              |
	| 1. array var @data => Güvenlik işlemine dahil edilecek veriler.                         |
	|          																				  |
	| Örnek Kullanım: ->secure(array(':x' => '1', ':y' => 2))				  				  |
	|          																				  |
	******************************************************************************************/
	public function secure($data = [])
	{
		if( ! is_array($data) ) 
		{
			\Errors::set('Error', 'arrayParameter', 'data');
		}
		else
		{
			$this->secure = $data;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	// PRIVATE QUERY SECURITY																  *
	// Sorgu güvenliği için oluşturulmuş 													  *
	// Sınıf içi güvenlik yeöntemi.                                                           *
	******************************************************************************************/	
	private function _querySecurity($query = '')
	{	
		if( isset($this->secure) ) 
		{
			$secure = $this->secure;
			
			$secureParams = [];
			
			if( is_numeric(key($secure)) )
			{	
				$strex  = explode('?', $query);	
				$newstr = '';
				
				if( ! empty($strex) ) for( $i = 0; $i < count($strex); $i++ )
				{
					$sec = isset($secure[$i])
					     ? $secure[$i]
					     : NULL;
							  
					$newstr .= $strex[$i].$this->db->realEscapeString($sec);
				}

				$query = $newstr;
			}
			else
			{
				foreach($this->secure as $k => $v)
				{
					$secureParams[$k] = $this->db->realEscapeString($v);
				}
			}
			
			$query = str_replace(array_keys($secureParams), array_values($secureParams), $query);
		}
		
		$this->stringQuery = $query;
		
		$this->secure = NULL;

		return $query;
	}
	
	/******************************************************************************************
	* MATH                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: SELECT FUNC()											 				  |
	
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	private function _math($type, $args = [])
	{
		$type    = strtoupper($type);
		$getLast = \Arrays::getLast($args);
		
		$asparam = ' ';
		
		if( $getLast === true )
		{
			$args   = \Arrays::removeLast($args);
			$return = true;
			
			$as     = \Arrays::getLast($args);
			
			if( stripos(trim($as), 'as') === 0 )
			{
				$asparam .= $as;
				$args   = \Arrays::removeLast($args);
			}
		}
		else
		{
			$return = false;	
		}
			
		if( stripos(trim($getLast), 'as') === 0 )
		{
			$asparam .= $getLast;
			$args     = \Arrays::removeLast($args);
		}
		
		$args = $type.'('.rtrim(implode(',', $args), ',').')'.$asparam;
		
		return (object)array
		(
			'args'   => $args,
			'return' => $return
		);
	}
	
	/******************************************************************************************
	* FUNC                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Select ile kullanılan herhangi bir fonksiyon oluşturmak içindir.		  |
	
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function func(...$args)
	{
		$array = \Arrays::removeFirst($args);
		$math  = $this->_math(isset($args[0]) ? mb_strtoupper($args[0]) : false, $array);
	
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* ERROR                                                                                   *
	******************************************************************************************/
	public function error()
	{
		\Errors::set($this->db->error()); 
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