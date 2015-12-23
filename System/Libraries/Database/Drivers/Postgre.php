<?php
class PostgreDriver implements DatabaseDriverInterface
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
		'autoIncrement' => 'AUTO_INCREMENT',
		'primaryKey'	=> 'PRIMARY KEY',
		'foreignKey'	=> 'FOREIGN KEY',
		'unique'		=> 'UNIQUE',
		'null'			=> 'NULL',
		'notNull'		=> 'NOT NULL',
		'constraint'	=> 'CONSTRAINT'
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
		'tinyInt'		=> 'SMALLINT',
		'mediumInt'		=> 'INTEGER',
		'bigInt'		=> 'BIGINT',
		'decimal'		=> 'DECIMAL',
		'double'		=> 'DOUBLE PRECISION',
		'float'			=> 'NUMERIC',
		'char'			=> 'CHARACTER',
		'varChar'		=> 'VARCHAR',
		'tinyText'		=> 'VARCHAR(255)',
		'text'			=> 'TEXT',
		'mediumText'	=> 'TEXT',
		'longText'		=> 'TEXT',
		'date'			=> 'DATE',
		'dateTime'		=> 'TIMESTAMP',
		'time'			=> 'TIME',
		'timeStamp'		=> 'TIMESTAMP'
	);
	
	use DatabaseDriverTrait;
	
	public function __construct()
	{
		if( ! function_exists('pg_connect') )
		{
			die(getErrorMessage('Error', 'undefinedFunctionExtension', 'postgre'));	
		}	
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
		
		$dsn = 'host='.$this->config['host'].' ';
		
		if( ! empty($this->config['port']) ) 		$dsn .= 'port='.$this->config['port'].' ';
		if( ! empty($this->config['database']) ) 	$dsn .= 'dbname='.$this->config['database'].' ';
		if( ! empty($this->config['user']) ) 		$dsn .= 'user='.$this->config['user'].' ';
		if( ! empty($this->config['password']) ) 	$dsn .= 'password='.$this->config['password'].' ';
		
		if( ! empty($this->config['dsn']) )
		{
			$dsn = $this->config['dsn'];	
		}
		
		$this->connect = ( $this->config['pconnect'] === true )
					     ? pg_pconnect(rtrim($dsn))
						 : pg_connect(rtrim($dsn));
		
		if( empty($this->connect) ) 
		{
			die(getErrorMessage('Database', 'mysqlConnectError'));
		}
		
		if( ! empty($this->config['charset']) ) 
		{
			pg_set_client_encoding($this->connect, $this->config['charset']);
		}
	}
	
	/******************************************************************************************
	* EXEC                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki exec yönteminin kullanımıdır.  			  |
	|          																				  |
	******************************************************************************************/
	public function exec($query, $security = NULL)
	{
		return pg_query($this->connect, $query);
	}
	
	/******************************************************************************************
	* QUERY                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki query yönteminin kullanımıdır.  			  |
	|          																				  |
	******************************************************************************************/
	public function query($query, $security = array())
	{
		$this->query = pg_query($this->connect, $query);
		return $this->query;
	}
	
	/******************************************************************************************
	* TRANS START                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki begin transaction özelliğinin kullanımıdır.  |		
	|          																				  |
	******************************************************************************************/
	public function transStart()
	{
		return (bool) pg_query($this->connect, 'BEGIN');
	}
	
	/******************************************************************************************
	* TRANS ROLLBACK                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki rollback özelliğinin kullanımıdır.  	  	  |
	|          																				  |
	******************************************************************************************/
	public function transRollback()
	{
		return (bool) pg_query($this->connect, 'ROLLBACK');	 
	}
	
	/******************************************************************************************
	* TRANS COMMIT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki commit özelliğinin kullanımıdır.        	  |
	|          																				  |
	******************************************************************************************/
	public function transCommit()
	{
		return (bool) pg_query($this->connect, 'COMMIT');
	}
	
	/******************************************************************************************
	* LIST DATABASES                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için bu yöntem desteklenmemektedir.                 		  | 
	|          																				  |
	******************************************************************************************/
	public function listDatabases()
	{
		// Ön tanımlı sorgu kullanılıyor.
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
		// Ön tanımlı sorgu kullanılıyor.
		return false;
	}
	
	/******************************************************************************************
	* INSERT ID                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için insert id kullanımıdır.                 		          |
	|          																				  |
	******************************************************************************************/
	public function insertId()
	{
		$version = pg_version($this->connect);
		
		$version = isset($version['server']) ? $version['server'] : 0;
		$table	 = (func_num_args() > 0) ? func_get_arg(0) : NULL;
		$column	 = (func_num_args() > 1) ? func_get_arg(1) : NULL;
		
		if( $table === NULL && $v >= '8.1' )
		{
			$sql = 'SELECT LASTVAL() AS ins_id';
		}
		elseif( $table !== NULL )
		{
			if( $column !== NULL && $version >= '8.0' )
			{
				$sql   = 'SELECT pg_get_serial_sequence(\''.$table."', '".$column."') AS seq";
				$query = $this->query($sql);
				$query = $query->row();
				$seq   = $query->seq;
			}
			else
			{
				$seq = $table;
			}
			
			$sql = 'SELECT CURRVAL(\''.$seq."') AS ins_id";
		}
		else
		{
			return pg_last_oid($this->query);
		}
		
		$query = $this->query($sql);
		$query = $query->row();
		
		return (int) $query->ins_id;
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
		
		$columns = array();
		
		for( $i = 0, $c = $this->num_fields(); $i < $c; $i++ )
		{
			$info = pg_field_name($this->query, $i);
			
			$columns[$i]			= new stdClass();
			$columns[$i]->name		= $info->column_name;
			$columns[$i]->type		= $info->data_type;
			$columns[$i]->maxLength	= $info->character_maximum_length;
		}
		
		return $columns;
	}
	
	/******************************************************************************************
	* BACKUP                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü bu yöntemi desteklememektedir.                				  | 
	|          																				  |
	******************************************************************************************/
	public function backup($filename = '')
	{
		// Ön tanımlı sorgu kullanıyor. 
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
	| Genel Kullanım: Bu sürücü için rename column kullanımıdır. 				  			  | 
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
		// Ön tanımlı sorgu kullanıyor.
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
		if( ! empty($this->query) )
		{
			return pg_num_rows($this->query);
		}
		else
		{
			return 0;	
		}
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
		$num_fields = $this->numFields();
		
		for($i=0; $i < $num_fields; $i++)
		{		
			$columns[] = pg_field_name($this->query, $i);
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
			return pg_num_fields($this->query);
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
		
		while($data = pg_fetch_assoc($this->query))
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
		
		while($data = pg_fetch_assoc($this->query))
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
		
		$data = pg_fetch_assoc($this->query);
		
		return (object)$data;
	}
	
	/******************************************************************************************
	* REAL STRING ESCAPE                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için bu kullanım desteklenmediği için. aşağıdaki yöntemden	  |
	| yararlanılmıştır.												 			              | 
	|          																				  |
	******************************************************************************************/
	public function realEscapeString($data = '')
	{
		return pg_escape_string($this->connect, $data);
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
			return pg_last_error($this->connect);
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
			return pg_fetch_array($this->query);
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
			return pg_fetch_assoc($this->query);
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
			return pg_affected_rows($this->query);
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
			return pg_affected_rows($this->connect);
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
			@pg_close($this->connect);
		}
		else 
		{
			return false;
		}
	}	
	
	/******************************************************************************************
	* VERSION                                                                         		  *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için bu yöntem desteklenmemektedir. 		                  | 
	|          																				  |
	******************************************************************************************/
	public function version()
	{
		// Ön tanımlı sorgu kullanıyor.
		if( ! empty($this->connect) ) 
		{
			return pg_version($this->connect);
		}
	}
}