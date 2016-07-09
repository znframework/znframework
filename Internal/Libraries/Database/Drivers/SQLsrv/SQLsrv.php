<?php
namespace ZN\Database\Drivers;

class SQLsrvDriver implements DatabaseDriverInterface
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
		'autoIncrement' => 'IDENTITY(1,1)',
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
		'mediumInt'		=> 'INT',
		'bigInt'		=> 'BIGINT',
		'decimal'		=> 'DECIMAL',
		'double'		=> 'DOUBLE PRECISION',
		'float'			=> 'FLOAT',
		'char'			=> 'CHAR',
		'varChar'		=> 'VARCHAR',
		'tinyText'		=> 'VARCHAR(255)',
		'text'			=> 'VARCHAR(65535)',
		'mediumText'	=> 'VARCHAR(16277215)',
		'longText'		=> 'VARCHAR(16277215)',
		'date'			=> 'DATE',
		'dateTime'		=> 'DATETIME',
		'time'			=> 'TIME',
		'timeStamp'		=> 'TIMESTAMP'
	);
	
	use SQLsrv\Traits\QueryTrait;
	use SQLsrv\Traits\ForgeTrait;
	use SQLsrv\Traits\ToolTrait;
	use SQLsrv\Traits\UserTrait;
	
	use Traits\DatabaseDriverTrait;
	
	public function __construct()
	{
		if( ! function_exists('sqlsrv_connect') )
		{
			die(getErrorMessage('Error', 'undefinedFunctionExtension', 'SQL Server'));	
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
		
		$server = 	( ! empty($this->config['server']) )
					? $this->config['server']
					: $this->config['host'];
					
		if( ! empty($this->config['port']) ) 
		{
			$server .= ', '.$this->config['port'];
		}
		
		$connection = array
		(
			'UID'					=> $this->config['user'],
			'PWD'					=> $this->config['password'],
			'Database'				=> $this->config['database'],
			'ConnectionPooling'		=> 0,
			'CharacterSet'			=> $this->config['charset'],
			'Encrypt'				=> $this->config['encode'],
			'ReturnDatesAsStrings'	=> 1
		);
		
		$this->connect = @sqlsrv_connect($server, $connection);
		
		if( empty($this->connect) ) 
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
		$this->query('SELECT @@IDENTITY AS insert_id');
		$row = $query->row();
		return $row->insert_id;
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
		
		foreach( sqlsrv_field_metadata($this->query) as $field )
		{
			$fieldName = $field['Name'];
			
			$columns[$fieldName]				= new \stdClass();
			$columns[$fieldName]->name			= $fieldName;
			$columns[$fieldName]->type			= $field['Type'];
			$columns[$fieldName]->maxLength		= $field['Size'];
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
	* RENAME COLUMN                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için rename column kullanımıdır. 				  			  | 
	|          																				  |
	******************************************************************************************/
	public function renameColumn()
	{ 
		return 'RENAME COLUMN TO'; 
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
			return sqlsrv_num_rows($this->query);
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
		
		$columns = [];
		$num_fields = $this->numFields();
		
		for($i=0; $i < $num_fields; $i++)
		{		
			$columns[] = sqlsrv_get_field($this->query, $i);
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
			return sqlsrv_num_fields($this->query);
		}
		else
		{
			return 0;	
		}
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
		return \Security::escapeStringEncode($data);
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
			$error = sqlsrv_errors(SQLSRV_ERR_ERRORS);
			return $error['message'];
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
			return sqlsrv_fetch_array($this->query, SQLSRV_FETCH_BOTH);
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
			return sqlsrv_fetch_array($this->query, SQLSRV_FETCH_ASSOC);
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
			return sqlsrv_fetch($this->query, SQLSRV_FETCH_ASSOC);
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
			return sqlsrv_rows_affected($this->connect);
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
			@sqlsrv_close($this->connect); 
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
	public function version()
	{
		if( ! empty($this->connect) )
		{
			$info = sqlsrv_server_info($this->connect);
			return $info['SQLServerVersion'];
		}
		else
		{
			return false;
		}
	}
}