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
			die(get_message('Database', 'db_driver_error', $this->select_driver));		
		}
		
		$this-> connect = 	$this->_sub_drivers($this->_dsn($this->config['dsn']), $this->config['user'], $this->config['password']); 	
		
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
	public function trans_start()
	{
		return $this->connect->beginTransaction();
	}
	
	/******************************************************************************************
	* TRANS ROLLBACK                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki rollback özelliğinin kullanımıdır.  	  	  |
	|          																				  |
	******************************************************************************************/
	public function trans_rollback()
	{
		return $this->connect->rollBack(); 
	}
	
	/******************************************************************************************
	* TRANS COMMIT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki commit özelliğinin kullanımıdır.        	  |
	|          																				  |
	******************************************************************************************/
	public function trans_commit()
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
		// Desteklemiyor.
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
		// Desteklemiyor.
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
		// Desteklemiyor. 
		return false; 
	}
	
	/******************************************************************************************
	* ADD COLUMN                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü bu yöntemi desteklememektedir.                				  | 
	|          																				  |
	******************************************************************************************/
	public function add_column()
	{
		// Desteklemiyor. 
		return false; 
	}
	
	/******************************************************************************************
	* DROP COLUMN                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü bu yöntemi desteklememektedir.                				  | 
	|          																				  |
	******************************************************************************************/
	public function drop_column()
	{ 
		// Desteklemiyor.
		return false; 
	}
	
	/******************************************************************************************
	* RENAME COLUMN                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü bu yöntemi desteklememektedir.                				  | 
	|          																				  |
	******************************************************************************************/
	public function rename_column()
	{
		// Desteklemiyor. 
		return false; 
	}
	
	/******************************************************************************************
	* MODIFY COLUMN                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü bu yöntemi desteklememektedir.			    				  | 
	|          																				  |
	******************************************************************************************/
	public function modify_column()
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
	private function _sub_drivers($dsn, $usr, $pass)
	{
		try
		{
			return new PDO($dsn, $usr, $pass);
		}
		catch(PDOException $e)
		{
			die(get_message('Database', 'db_mysql_connect_error'));
		}
	}
	
	// Farklı alt sürücülere göre bağlantı çeşitleri.
	private function _dsn($dsn = '')
	{
		if( ! empty($dsn) ) 
		{
			return $dsn;
		}
		
		$dsn = '';
		
		// 4D SÜRÜCÜ BAĞLANTISI
		if( $this->select_driver === '4d' )
		{
			$dsn  = '4d:host='.( empty($this->config['host']) ) 
				   			   ? '127.0.0.1' 
							   : $this->config['host'];
							   
			$dsn .= ( ! empty($this->config['database']) ) 
					? ';dbname='.$this->config['database'] 
					: '';
					
			$dsn .= ( ! empty($this->config['port']) ) 
					? ';port='.$this->config['port'] 
					: '';
					
			$dsn .= ( ! empty($this->config['charset']) ) 
					? ';charset='.$this->config['charset'] 
					: '';
		}
		// CUBRID SÜRÜCÜ BAĞLANTISI
		elseif( $this->select_driver === 'cubrid' )
		{
			$dsn  = 'cubrid:host='.( empty($this->config['host']) ) 
								   ? '127.0.0.1' 
								   : $this->config['host'];
			
			$dsn .= ( ! empty($this->config['database']) ) 
					? ';dbname='.$this->config['database'] 
					: '';
					
			$dsn .= ( ! empty($this->config['port']) ) 
					? ';port='.$this->config['port'] 
					: '';
					
			$dsn .= ( ! empty($this->config['charset']) ) 
					? ';charset='.$this->config['charset'] 
					: '';
		}
		// DBLIB SÜRÜCÜ BAĞLANTISI
		elseif( $this->select_driver === 'dblib' )
		{
			$dsn  = 'dblib:host='.( empty($this->config['host']) ) 
								  ? '127.0.0.1' 
								  : $this->config['host'];
								  
			$dsn .= ( ! empty($this->config['database']) ) 
					? ';dbname='.$this->config['database'] 
					: '';
					
			$dsn .= ( ! empty($this->config['port']) ) 
					? ';port='.$this->config['port'] 
					: '';
					
			$dsn .= ( ! empty($this->config['appname']) ) 
					? ';appname='.$this->config['appname'] 
					: '';
					
			$dsn .= ( ! empty($this->config['charset']) ) 
					? ';charset='.$this->config['charset'] 
					: '';
		}
		// FIREBIRD SÜRÜCÜ BAĞLANTISI
		elseif( $this->select_driver === 'firebird' )
		{
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
		}
		// IBM SÜRÜCÜ BAĞLANTISI
		elseif( $this->select_driver === 'ibm' )
		{
			$dsn  = 'DRIVER:{IBM DB2 ODBC DRIVER}'.
			
			$dsn .= ( ! empty($this->config['database']) ) 
					? ';DATABASE='.$this->config['database'] 
					: '';
					
			$dsn .= ( ! empty($this->config['host']) ) 
					? ';HOSTNAME='.$this->config['host'] 
					: '';
					
			$dsn .= ( ! empty($this->config['port']) ) 
					? ';PORT='.$this->config['port'] 
					: '';
					
			$dsn .= ( ! empty($this->config['protocol']) ) 
					? ';PROTOCOL='.$this->config['protocol'] 
					: ';PROTOCOL=TCPIP';
		}
		// INFORMIX SÜRÜCÜ BAĞLANTISI
		elseif( $this->select_driver === 'informix' )
		{
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
		}
		// MYSQL SÜRÜCÜ BAĞLANTISI
		elseif( $this->select_driver === 'mysql' )
		{	
			$dsn  = 'mysql:host='.
			
			$dsn .= ( empty($this->config['host']) ) 
					? '127.0.0.1' 
					: $this->config['host'];
					
			$dsn .= ( ! empty($this->config['database']) ) 
					? ';dbname='.$this->config['database'] 
					: '';
					
			$dsn .= ( ! empty($this->config['port']) ) 
					? ';PORT='.$this->config['port'] 
					: '';
					
			$dsn .= ( ! empty($this->config['charset']) ) 
					? ';charset='.$this->config['charset'] 
					: '';
		}
		// OCI SÜRÜCÜ BAĞLANTISI
		elseif( $this->select_driver === 'oci' )
		{
			$dsn  = 'oci:dbname='.
			
			$dsn .= ( empty($this->config['host']) ) 
					? ';dbname=127.0.0.1' 
					: 'dbname=//'.$this->config['host'];
					
			$dsn .= ( ! empty($this->config['database']) ) 
					? ';dbname='.$this->config['database'] 
					: '';
					
			$dsn .= ( ! empty($this->config['port']) ) 
					? ':'.$this->config['port'] 
					: '';
			
			$dsn .= ( ! empty($this->config['charset']) ) 
					? ';charset='.$this->config['charset'] 
					: '';
		}
		// ODBC SÜRÜCÜ BAĞLANTISI
		elseif( $this->select_driver === 'odbc' )
		{
			$dsn  = 'odbc:DRIVER={IBM DB2 ODBC DRIVER}'.
			
			$dsn .= ( ! empty($this->config['database']) ) 
					? ';DATABASE='.$this->config['database'] 
					: '';
					
			$dsn .= ( ! empty($this->config['host']) ) 
					? ';HOSTNAME='.$this->config['host'] 
					: '';
					
			$dsn .= ( ! empty($this->config['port']) ) 
					? ';PORT='.$this->config['port'] 
					: '';
					
			$dsn .= ( ! empty($this->config['protocol']) ) 
					? ';PROTOCOL='.$this->config['protocol'] 
					: ';PROTOCOL=TCPIP';
					
			$dsn .= ( ! empty($this->config['user']) ) 
					? ';UID='.$this->config['user'] 
					: '';
			
			$dsn .= ( ! empty($this->config['password']) ) 
					? ';PWD='.$this->config['password'] 
					: '';
		}
		// PGSQL SÜRÜCÜ BAĞLANTISI 
		elseif( $this->select_driver === 'pgsql' )
		{
			$dsn  = 'pgsql:host='.
			
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
		}
		// SQLITE SÜRÜCÜ BAĞLANTISI
		elseif( $this->select_driver === 'sqlite' )
		{
			$dsn = 'sqlite:';
			
			if( ! empty($this->config['database']) )
			{
				$dsn .= $this->config['database'];
			}
			elseif( ! empty($this->config['host']) ) 
			{
				$dsn .= $this->config['host'];
			}
			else 
			{
				$dsn .= ':memory:';
			}
		}
		// SQLSRV SÜRÜCÜ BAĞLANTISI
		elseif( $this->select_driver === 'sqlsrv' )
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
					
		}
	
		return $dsn;
	}
}
