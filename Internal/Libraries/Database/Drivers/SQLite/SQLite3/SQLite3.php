<?php
namespace ZN\Database\Drivers;

class SQLite3Driver implements DatabaseDriverInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------

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
		'autoIncrement' => 'AUTOINCREMENT',
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
		'int' 			=> 'INTEGER',
		'smallInt'		=> 'SMALLINT',
		'tinyInt'		=> 'TINYINT',
		'mediumInt'		=> 'MEDIUMINT',
		'bigInt'		=> 'BIGINT',
		'decimal'		=> 'DECIMAL',
		'double'		=> 'DOUBLE',
		'float'			=> 'FLOAT',
		'char'			=> 'CHARACTER',
		'varChar'		=> 'VARCHAR',
		'tinyText'		=> 'VARCHAR(255)',
		'text'			=> 'TEXT',
		'mediumText'	=> 'CLOB',
		'longText'		=> 'BLOB',
		'date'			=> 'DATE',
		'dateTime'		=> 'DATETIME',
		'time'			=> 'DATE',
		'timeStamp'		=> 'DATETIME'
	);
	
	use SQLite3\Traits\QueryTrait;
	use SQLite3\Traits\ForgeTrait;
	use SQLite3\Traits\ToolTrait;
	use SQLite3\Traits\UserTrait;
	
	use Traits\DatabaseDriverTrait;
	
	public function __construct()
	{
		if( ! extension_loaded('SQLite3') )
		{
			die(getErrorMessage('Error', 'undefinedFunctionExtension', 'SQLite3'));	
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
		
		try
		{
			$this->connect = 	( ! empty($this->config['password']) )
							 	? new \SQLite3($this->config['database'], SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE, $this->config['password'])
							  	: new \SQLite3($this->config['database']);
		}	
		catch(Exception $e)
		{
			die(getErrorMessage('Database', 'mysqlConnectError'));
		}
	}	

	/******************************************************************************************
	* INSERT ID                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için insert id kullanımıdır.                 		          |
	|          																				  |
	******************************************************************************************/
	public function insertId()
	{
		return $this->connect->lastInsertRowID();
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
		
		$dataTypes = array
		(
			SQLITE3_INTEGER	=> 'integer',
			SQLITE3_FLOAT	=> 'float',
			SQLITE3_TEXT	=> 'text',
			SQLITE3_BLOB	=> 'blob',
			SQLITE3_NULL	=> 'null'
		);
		
		$columns = [];
		
		for ($i = 0, $c = $this->numFields(); $i < $c; $i++)
		{	
			$type 		= $this->query->columnType($i);
			$fieldName 	= $this->query->columnName($i);
			
			$columns[$fieldName]				= new \stdClass();
			$columns[$fieldName]->name			= $fieldName;
			$columns[$fieldName]->type			= isset($dataTypes[$type]) ? $dataTypes[$type] : $type;
			$columns[$fieldName]->maxLength		= NULL;
			$columns[$fieldName]->primaryKey	= NULL;
			$columns[$fieldName]->default		= NULL;
		}
		
		if( isset($columns[$col]) )
		{
			return $columns[$col];
		}
		
		return $columns;
	}
	
	/******************************************************************************************
	* TRUNCATE                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Db sınıfında kullanımı için oluşturulmuş truncate yöntemidir.           | 
	|          																				  |
	******************************************************************************************/		
	public function truncate($table = '')
	{ 
		return 'DELETE FROM '.$table; 
	}
	
	/******************************************************************************************
	* NUM ROWS                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için toplam kayıt sayısı bilgisini verir.                	  | 
	|          																				  |
	******************************************************************************************/
	public function numRows()
	{
		if( empty($this->result) ) 
		{
			return false;
		}
		
		return count($this->result());
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
		$num_fields = $this->numFields();
		
		for($i=0; $i < $num_fields; $i++)
		{		
			$columns[] = $this->query->columnName($i);
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
		if( ! empty($this->query) )
		{
			return $this->query->numColumns();
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
		
		return $this->connect->escapeString($data);
	}
	
	/******************************************************************************************
	* ERROR                                                                      			  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için hata bilgisini verir. 			              			  | 
	|          																				  |
	******************************************************************************************/
	public function error()
	{
		if( ! empty($this->connect) )
		{
			return $this->connect->lastErrorMsg();
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
			return $this->query->fetchArray(SQLITE3_BOTH);
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
			return $this->query->fetchArray(SQLITE3_ASSOC);
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
			return $this->query->fetchArray();
		}
		else
		{
			return 0;	
		}
	}
	
	/******************************************************************************************
	* AFFECTED ROWS                                                                 		  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için bu yöntem desteklenmemektedir. 		         		  | 
	|          																				  |
	******************************************************************************************/
	public function affectedRows()
	{
		if( ! empty($this->connect) )
		{
			return  $this->connect->changes();
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
		if( ! empty($this->connect) ) 
		{
			@$this->connect->close(); 
		}
		else 
		{
			return false;
		}
	}
	
	/******************************************************************************************
	* VERSION                                                                         		  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için version yönteminin kullanımıdır. 		                  | 
	|          																				  |
	******************************************************************************************/
	public function version($v = 'versionString')
	{
		if( ! empty($this->connect) )
		{
			$version = \SQLite3::version();
			
			return $version[$v];
		}
		else
		{
			return false;
		}
	}
}