<?php
namespace ZN\Database\Drivers;

class PDODriver implements DatabaseDriverInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------

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
	protected $operators = array
	(
		'like' => '%'
	);
	
	/* Statements Değişkeni
	 *  
	 * Farklı platformlardaki yapısal farklılıklar bilgisi
	 * tutmak için oluşturulmuştur.
	 *
	 */
	protected $statements = array
	(
		'autoIncrement' => 'AUTO_INCREMENT',
		'primaryKey'	=> 'PRIMARY KEY',
		'foreignKey'	=> 'FOREIGN KEY',
		'unique'		=> 'UNIQUE',
		'null'			=> 'NULL',
		'notNull'		=> 'NOT NULL',
		'constraint'	=> 'CONSTRAINT',
		'default'		=> 'DEFAULT'
	);
	
	/* Variable Types Değişkeni
	 *  
	 * Farklı platformlardaki değişken tür farklılıklar bilgisi
	 * tutmak için oluşturulmuştur.
	 *
	 */
	protected $variableTypes = array
	(
		'int' 			=> 'INT',
		'smallInt'		=> 'SMALLINT',
		'tinyInt'		=> 'TINYINT',
		'mediumInt'		=> 'MEDIUMINT',
		'bigInt'		=> 'BIGINT',
		'decimal'		=> 'DECIMAL',
		'double'		=> 'DOUBLE',
		'float'			=> 'FLOAT',
		'char'			=> 'CHAR',
		'varChar'		=> 'VARCHAR',
		'tinyText'		=> 'TINYTEXT',
		'text'			=> 'TEXT',
		'mediumText'	=> 'MEDIUMTEXT',
		'longText'		=> 'LONGTEXT',
		'date'			=> 'DATE',
		'dateTime'		=> 'DATETIME',
		'time'			=> 'TIME',
		'timeStamp'		=> 'TIMESTAMP'
	);
	
	use PDO\Traits\QueryTrait;
	use PDO\Traits\ForgeTrait;
	use PDO\Traits\ToolTrait;
	use PDO\Traits\UserTrait;
	
	use Traits\DatabaseDriverTrait;
	
	public function __construct()
	{
		if( ! extension_loaded('PDO') )
		{
			die(getErrorMessage('Error', 'undefinedFunctionExtension', 'PDO'));	
		}
	}
	
	/******************************************************************************************
	* CONNECT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Nesne tanımlaması ve veritabanı ayarları çalıştırılıyor.				  |
	|          																				  |
	******************************************************************************************/
	public function connect($config = [])
	{
		$this->config = $config;
		
		if( strstr($this->config['driver'], ':') )
		{
			$subdrivers = explode(":", $this->config['driver']);
			$this->select_driver  = $subdrivers[1];
		}
		
		if( empty($this->select_driver) ) 
		{
			$this->select_driver = 'mysql';
		}
		
		if( ! in_array($this->select_driver, $this->pdo_subdrivers) )
		{
			die(\Errors::message('Database', 'driverError', $this->select_driver));		
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
	public function columnData($col = '')
	{
		if( empty($this->query) ) 
		{
			return false;
		}
		
		$columns = [];
		
		for ($i = 0, $c = $this->numFields(); $i < $c; $i++)
		{
			$field     = $this->query->getColumnMeta($i);
			$fieldName = $field['name'];
			
			$columns[$fieldName]				= new \stdClass();
			$columns[$fieldName]->name			= $fieldName;
			$columns[$fieldName]->type			= $field['native_type'];
			$columns[$fieldName]->maxLength		= ($field['len'] > 0) ? $field['len'] : NULL;
			$columns[$fieldName]->primaryKey	= (int) ( ! empty($field['flags']) && in_array('primary_key', $field['flags'], TRUE));
			$columns[$fieldName]->default		= NULL;
		}
		
		if( isset($columns[$col]) )
		{
			return $columns[$col];
		}
		
		return $columns;
	
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
		
		$columns = [];
		
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
			$error = $this->connect->errorInfo();
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
			return $this->query->fetch(\PDO::FETCH_BOTH);
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
			return $this->query->fetch(\PDO::FETCH_ASSOC);
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
		if( ! empty($this->query) )
		{
			return $this->query->rowCount();
		}
		else
		{
			return 0;	
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
			return $this->connect->getAttribute(\PDO::ATTR_SERVER_VERSION);
		}
		else
		{
			return false;
		}
	}
	
	// Alt sürücüler nesne oluşturulma işlemi.
	private function _sub_drivers($usr, $pass)
	{
		$driver = 'ZN\Database\Drivers\PDO\SubDrivers\PDO'.$this->select_driver.'Driver';
		
		$this->sub_driver = new $driver;
	
		try
		{
			return new \PDO($this->sub_driver->dsn(), $usr, $pass);
		}
		catch(PDOException $e)
		{
			die(getErrorMessage('Database', 'mysqlConnectError'));
		}
		
	}
}