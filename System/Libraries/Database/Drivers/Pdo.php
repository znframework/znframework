<?php
/************************************************************/
/*                     PDO DRIVER LIBRARY                   */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* PDO DRIVER		                                                                      *
*******************************************************************************************
| Dahil(Import) Edilirken : Dahil Edilemez.  							                  |
| Sınıfı Kullanırken      :	Kullanılamaz.												  |
| 																						  |
| NOT: Veritabanı kütüphaneler için oluşturulmuş yardımcı sınıftır.                       |
******************************************************************************************/
class PdoDriver
{
	/* Config Değişkeni
	 *  
	 * Veritabanı ayarlar bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $config;
	
	/* Connect Değişkeni
	 *  
	 * Veritabanı bağlantı bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $connect;
	
	/* Query Değişkeni
	 *  
	 * Veritabanı sorgu bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $query;
	
	/* Select Drivers Değişkeni
	 *  
	 * Alt sürücü bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $select_driver;
	
	/* Pdo Select Drivers Değişkeni
	 *  
	 * Alt sürücüler liste bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $pdo_subdrivers = array
	(
		'4d',
		'cubrid',
		'dblib',
		'firebird',
		'ibm',
		'informix',
		'mysql',
		'oci',
		'odbc',
		'pgsql',
		'sqlite',
		'sqlsrv'
	);
	
	/* Sub Driver Değişkeni
	 *  
	 * PDO Alt sürücü bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	private $sub_driver;
	
	/******************************************************************************************
	* CONNECT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Nesne tanımlaması ve veritabanı ayarları çalıştırılıyor.				  |
	|          																				  |
	******************************************************************************************/
	public function connect($config = array())
	{
		$this->config = $config;
		
		if( strstr($this->config['driver'], '->') )
		{
			$subdrivers = explode('->', $this->config['driver']);
			$this->select_driver  = $subdrivers[1];
		}
		
		
		if( empty($this->select_driver) ) 
		{
			$this->select_driver = 'mysql';
		}
		
		if( ! in_array($this->select_driver, $this->pdo_subdrivers) )
		{
			die(getMessage('Database', 'driverError', $this->select_driver));		
		}
		
		$this-> connect = $this->_sub_drivers($this->config['user'], $this->config['password']); 	
		
		// Mysql için karakterseti sorguları
		if( $this->select_driver === 'mysql' )
		{
			if( ! empty($this->config['charset']) )
			{   
				$this->connect->exec("SET NAMES '".$this->config['charset']."'");
			}
			if( ! empty($this->config['charset']) )
			{   
				$this->connect->exec('SET CHARACTER SET '.$this->config['charset']);	
			}
			if( ! empty($this->config['collation']) )
			{ 
				$this->connect->exec("SET COLLATION_CONNECTION = '".$this->config['collation']."'");	
			}
		}
	}	
	
	/******************************************************************************************
	* EXEC                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki exec yönteminin kullanımıdır.  			  |
	|          																				  |
	******************************************************************************************/
	public function exec($query)
	{
		return $this->connect->exec($query);
	}
	
	/******************************************************************************************
	* QUERY                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki query yönteminin kullanımıdır.  			  |
	|          																				  |
	******************************************************************************************/	
	public function query($query, $security = array())
	{
		$this->query = $this->connect->prepare($query);
		$this->query->execute($security);
		return $this->query;
	}
	
	/******************************************************************************************
	* TRANS START                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki strat transaction özelliğinin kullanımıdır.  |
	|          																				  |
	******************************************************************************************/
	public function transStart()
	{
		return $this->connect->beginTransaction();
	}
	
	/******************************************************************************************
	* TRANS ROLLBACK                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki rollback özelliğinin kullanımıdır.  	  	  |
	|          																				  |
	******************************************************************************************/
	public function transRollback()
	{
		return $this->connect->rollBack(); 
	}
	
	/******************************************************************************************
	* TRANS COMMIT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki commit özelliğinin kullanımıdır.        	  |
	|          																				  |
	******************************************************************************************/
	public function transCommit()
	{
		return $this->connect->commit();
	}
	
	/******************************************************************************************
	* LIST DATABASES                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için bu yöntem desteklenmemektedir.                 		  | 
	|          																				  |
	******************************************************************************************/
	public function list_databases()
	{
		// Ön tanımlı sorgu kullanıyor.
		return false;
	}
	
	/******************************************************************************************
	* LIST TABLES                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için bu yöntem desteklenmemektedir.                 		  | 
	|          																				  |
	******************************************************************************************/
	public function list_tables()
	{
		// Ön tanımlı sorgu kullanıyor.
		return false;
	}
	
	/******************************************************************************************
	* INSERT ID                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Db sınıfında kullanımı için oluşturulmuş yöntemdir.                	  | 
	|          																				  |
	******************************************************************************************/
	public function insert_id()
	{
		if( ! empty($this->connect) )
		{
			return $this->connect->lastInsertId('id');
		}
		else
		{
			return false;
		}
	}
	
	/******************************************************************************************
	* COLUMN DATA                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Db sınıfında kullanımı için oluşturulmuş yöntemdir.                	  | 
	|          																				  |
	******************************************************************************************/
	public function column_data()
	{
		if( empty($this->query) ) 
		{
			return false;
		}
		
		try
		{
			$columns = array();
			
			for ($i = 0, $c = $this->num_fields(); $i < $c; $i++)
			{
				$field = $this->query->getColumnMeta($i);
				$columns[$i]				= new stdClass();
				$columns[$i]->name			= $field['name'];
				$columns[$i]->type			= $field['native_type'];
				$columns[$i]->max_length	= ($field['len'] > 0) ? $field['len'] : NULL;
				$columns[$i]->primary_key	= (int) ( ! empty($field['flags']) && in_array('primary_key', $field['flags'], TRUE));
			}
			return $columns;
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/******************************************************************************************
	* BACKUP                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü bu yöntemi desteklememektedir.                				  | 
	|          																				  |
	******************************************************************************************/
	public function backup($filename = '')
	{ 
		return false; 
	}
	
	/******************************************************************************************
	* TRUNCATE                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü bu yöntemi desteklememektedir.                				  |  
	|          																				  |
	******************************************************************************************/	
	public function truncate($table = '')
	{
		// Ön tanımlı sorgu kullanıyor. 
		return false; 
	}
	
	/******************************************************************************************
	* ADD COLUMN                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü bu yöntemi desteklememektedir.                				  | 
	|          																				  |
	******************************************************************************************/
	public function addColumn()
	{
		// Ön tanımlı sorgu kullanıyor. 
		return false; 
	}
	
	/******************************************************************************************
	* DROP COLUMN                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü bu yöntemi desteklememektedir.                				  | 
	|          																				  |
	******************************************************************************************/
	public function dropColumn()
	{ 
		// Ön tanımlı sorgu kullanıyor.
		return false; 
	}
	
	/******************************************************************************************
	* RENAME COLUMN                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü bu yöntemi desteklememektedir.                				  | 
	|          																				  |
	******************************************************************************************/
	public function renameColumn()
	{
		// Ön tanımlı sorgu kullanıyor. 
		return false; 
	}
	
	/******************************************************************************************
	* MODIFY COLUMN                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü bu yöntemi desteklememektedir.			    				  | 
	|          																				  |
	******************************************************************************************/
	public function modifyColumn()
	{ 
		return false; 
	}
	
	/******************************************************************************************
	* NUM ROWS                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için toplam kayıt sayısı bilgisini verir.                	  | 
	|          																				  |
	******************************************************************************************/
	public function num_rows()
	{
		return $this->query->rowCount();	
	}
	
	/******************************************************************************************
	* COLUMNS                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için sütun özellikleri bilgisini verir.                	      | 
	|          																				  |
	******************************************************************************************/
	public function columns()
	{
		if( empty($this->query) ) 
		{
			return false;
		}
		
		$columns = array();
		
		$total_columns = $this->num_fields();
		
		for ($i = 0; $i < $total_columns; $i ++) 
		{
			$meta = $this->query->getColumnMeta($i);
			
			if($meta['name'] !== NULL)
				$columns[] = $meta['name'];
		}
		
		return $columns;
	}
	
	/******************************************************************************************
	* NUM FIEDLS                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için toplam sütun sayısı bilgisini verir.                	  | 
	|          																				  |
	******************************************************************************************/
	public function num_fields()
	{
		if( isset($this->query) )
		{
			return $this->query->columnCount();
		}
		else
		{
			return 0;
		}
	}
	
	/******************************************************************************************
	* RESULT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için sorgu sonucu kayıtlar bilgisini verir.                	  | 
	|          																				  |
	******************************************************************************************/
	public function result()
	{
		if( empty($this->query) ) 
		{
			return false;
		}
		
		$rows = array();
		
		while($data = $this->query->fetch(PDO::FETCH_ASSOC))
		{
			$rows[] = (object)$data;
		}
		
		return $rows;
	}
	
	/******************************************************************************************
	* RESULT ARRAY                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için sorgu sonucu kayıtlar bilgisini dizi olarak verir.       | 
	|          																				  |
	******************************************************************************************/
	public function result_array()
	{
		if( empty($this->query) ) 
		{
			return false;
		}
		
		$rows = array();
		
		while($data = $this->query->fetch(PDO::FETCH_ASSOC))
		{
			$rows[] = $data;
		}
		
		return $rows;
	
	}
	
	/******************************************************************************************
	* ROW                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için sorgu sonucu tek bir kayıt bilgisini verir.              | 
	|          																				  |
	******************************************************************************************/
	public function row()
	{
		if( empty($this->query) ) 
		{
			return false;
		}
		
		$data = $this->query->fetch(PDO::FETCH_ASSOC);
		
		return (object)$data;
	}
	
	/******************************************************************************************
	* REAL STRING ESCAPE                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için real_escape_string yönteminin kullanımıdır.			  | 
	|          																				  |
	******************************************************************************************/
	public function real_escape_string($data = '')
	{
		if( empty($this->connect) ) 
		{
			return false;
		}
		
		return $this->connect->quote($data);
	}
	
	/******************************************************************************************
	* ERROR                                                                      			  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için hata bilgisini verir. 			              			  | 
	|          																				  |
	******************************************************************************************/
	public function error()
	{
		if( isset($this->connect) )
		{
			$error = $this->query->errorInfo();
			return $error[2];
		}
		else
		{
			return false;
		}
	}
	
	/******************************************************************************************
	* FETCH ARRAY                                                                 			  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için fetch_array yönteminin kullanımıdır. 		              | 
	|          																				  |
	******************************************************************************************/
	public function fetch_array()
	{
		if( ! empty($this->query) )
		{
			return $this->query->fetch(PDO::FETCH_BOTH);
		}
		else
		{
			return false;	
		}
	}
	
	/******************************************************************************************
	* FETCH ASSOC                                                                  			  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için fetch_array yönteminin kullanımıdır. 		              | 
	|          																				  |
	******************************************************************************************/
	public function fetch_assoc()
	{
		if( ! empty($this->query) )
		{
			return $this->query->fetch(PDO::FETCH_ASSOC);
		}
		else
		{
			return false;	
		}
	}
	
	/******************************************************************************************
	* FETCH ROW                                                                  			  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için fetch_row yönteminin kullanımıdır. 		              | 
	|          																				  |
	******************************************************************************************/
	public function fetch_row()
	{
		if( ! empty($this->query) )
		{
			return $this->query->fetch();
		}
		else
		{
			return 0;	
		}
	}
	
	/******************************************************************************************
	* AFFECTED ROWS                                                                 		  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için affected_rows yönteminin kullanımıdır. 		          | 
	|          																				  |
	******************************************************************************************/
	public function affected_rows()
	{
		if( ! empty($this->connect) )
		{
			return false;
		}
		else
		{
			return false;	
		}
	}
	
	/******************************************************************************************
	* CLOSE                                                                         		  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için close yönteminin kullanımıdır. 		                  | 
	|          																				  |
	******************************************************************************************/
	public function close()
	{
		if( isset($this->connect) ) 
		{
			$this->connect = NULL;	
		}
	}
	
	/******************************************************************************************
	* VERSION                                                                         		  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için versiyon bilgisi verir.                 		          | 
	|          																				  |
	******************************************************************************************/
	public function version()
	{
		if( ! empty($this->connect) ) 
		{
			return $this->connect->getAttribute(PDO::ATTR_SERVER_VERSION);
		}
		else
		{
			return false;
		}
	}
	
	// Alt sürücüler nesne oluşturulma işlemi.
	private function _sub_drivers($usr, $pass)
	{
		$driver = 'PDO'.ucwords($this->select_driver).'Driver';
		
		require_once(SYSTEM_LIBRARIES_DIR.'Database/Drivers/PDODrivers/'.suffix($this->select_driver, '.php'));
		
		$this->sub_driver = new $driver;
		
		try
		{
			return new PDO($this->sub_driver->dsn(), $usr, $pass);
		}
		catch(PDOException $e)
		{
			die(getMessage('Database', 'mysqlConnectError'));
		}
	}
}