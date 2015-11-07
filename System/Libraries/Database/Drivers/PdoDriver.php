<?php
class PdoDriver
{
	/***********************************************************************************/
	/* PDO DRIVER LIBRARY   					                   	                   */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: PdoDriver
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Database kütüphanesi tarafından kullanılmaktadır.
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	use DBDriverCommonTrait;
	
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
	
	/* Operators Değişkeni
	 *  
	 * Farklı platformlardaki operator farklılıklar bilgisi
	 * tutmak için oluşturulmuştur.
	 *
	 */
	public $operators = array
	(
		'like' => '%'
	);

	public function autoIncrement()
	{
		return ' AUTO_INCREMENT ';
	}
	
	public function primaryKey($col = '')
	{
		return $this->cvartype('PRIMARY KEY', $col);
	}
	
	public function foreignKey($col = '')
	{
		return $this->cvartype('FOREIGN KEY', $col);
	}
	
	public function unique($col = '')
	{
		return $this->cvartype('UNIQUE', $col);
	}
	
	public function null($type = true)
	{
		return $type === true ? ' NULL ' : ' NOT NULL ';
	}
	
	public function notNull()
	{
		return ' NOT NULL ';
	}
	
	 // NUMERICAL
	public function int($len = '')
	{
		return $this->cvartype('INT', $len);
	}
	
	public function smallInt($len = '')
	{
		return $this->cvartype('SMALLINT', $len);
	}
	
	public function tinyInt($len = '')
	{
		return $this->cvartype('TINYINT', $len);
	}
	
	public function mediumInt($len = '')
	{
		return $this->cvartype('MEDIUMINT', $len);
	}
	
	public function bigInt($len = '')
	{
		return $this->cvartype('BIGINT', $len);
	}
	
	public function decimal($len = '')
	{
		return $this->cvartype('DECIMAL', $len);
	}
	
	public function double($len = '')
	{
		return $this->cvartype('DOUBLE', $len);
	}
	
	public function float($len = '')
	{
		return $this->cvartype('FLOAT', $len);
	}
	
	// STRING
	public function char($len = '')
	{
		return $this->cvartype('CHAR', $len);
	}
	
	public function varChar($len = '')
	{
		return $this->cvartype('VARCHAR', $len);
	}
	
	// max.255 karakter
	public function tinyText()
	{
		return $this->cvartype('TINYTEXT');
	}
	
	// max. 65535 karakter 
	public function text()
	{
		return $this->cvartype('TEXT');
	}
	
	// max. 16777215 karakter 
	public function mediumText()
	{
		return $this->cvartype('MEDIUMTEXT');
	}
	
	// max. 4294967295 karakter
	public function longText()
	{
		return $this->cvartype('LONGTEXT');
	}
	
	// DATETIME
	// yyyy-mm-dd
	public function date($len = '')
	{
		return $this->cvartype('DATE', $len);
	}
	
	// yyyy-mm-dd hh:mm:ss
	public function datetime($len = '')
	{
		return $this->cvartype('DATETIME', $len);
	}
	
	// hh:mm:ss
	public function time($len = '')
	{
		return $this->cvartype('TIME', $len);
	}
	
	// yyyymmddhhmmss
	public function timeStamp($len = '')
	{
		return $this->cvartype('TIMESTAMP', $len);
	}
	
	// ENUM ENUMERATED listesinin kisaltılmış halidir. () içinde 65535 değer tutabilir
	public function enum($args = array())
	{
		$args = "'".implode("','", $args)."'";
		
		return " ENUM($args) ";
	}
	
	// ENUM ENUMERATED listesinin kisaltılmış halidir. () içinde 65535 değer tutabilir
	public function set($args = array())
	{
		$args = "'".implode("','", $args)."'";
		
		return " SET($args) ";
	}
	
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
	public function listDatabases()
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
	public function listTables()
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
	public function insertId()
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
	public function columnData()
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
				$columns[$i]->maxLength		= ($field['len'] > 0) ? $field['len'] : NULL;
				$columns[$i]->primaryKey	= (int) ( ! empty($field['flags']) && in_array('primary_key', $field['flags'], TRUE));
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
	public function numRows()
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
		
		$total_columns = $this->numFields();
		
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
	public function numFields()
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
	public function resultArray()
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
	public function realEscapeString($data = '')
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
	public function fetchArray()
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
	public function fetchAssoc()
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
	public function fetchRow()
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
	public function affectedRows()
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
		$driver = 'PDO'.ucfirst($this->select_driver).'Driver';
		
		$this->sub_driver = new $driver;
		
		try
		{
			return new PDO($this->sub_driver->dsn(), $usr, $pass);
		}
		catch(PDOException $e)
		{
			die(getErrorMessage('Database', 'mysqlConnectError'));
		}
	}
}