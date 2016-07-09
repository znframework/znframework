<?php
namespace ZN\Database\Drivers;

class SybaseDriver implements DatabaseDriverInterface
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
		'mediumInt'		=> 'INTEGER',
		'bigInt'		=> 'BIGINT',
		'decimal'		=> 'DECIMAL',
		'double'		=> 'DOUBLE',
		'float'			=> 'FLOAT',
		'char'			=> 'CHAR',
		'varChar'		=> 'VARCHAR',
		'tinyText'		=> 'VARCHAR(255)',
		'text'			=> 'LONG VARCHAR(65535)',
		'mediumText'	=> 'LONG VARCHAR(16277215)',
		'longText'		=> 'LONG VARCHAR(16277215)',
		'date'			=> 'DATE',
		'dateTime'		=> 'TIMESTAMP',
		'time'			=> 'TIME',
		'timeStamp'		=> 'TIMESTAMP'
	);
	
	use Sybase\Traits\QueryTrait;
	use Sybase\Traits\ForgeTrait;
	use Sybase\Traits\ToolTrait;
	use Sybase\Traits\UserTrait;
	
	use Traits\DatabaseDriverTrait;
	
	public function __construct()
	{
		if( ! function_exists('sybase_connect') )
		{
			die(getErrorMessage('Error', 'undefinedFunctionExtension', 'Sybase'));	
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
		$this->connect = 	( $this->config['pconnect'] === true )
							? @sybase_pconnect($this->config['host'], $this->config['user'], $this->config['password'] , $this->config['charset'] , $this->config['appname'])
							: @sybase_connect($this->config['host'], $this->config['user'], $this->config['password'] , $this->config['charset'] , $this->config['appname']);
		
		if( empty($this->connect) ) 
		{
			die(getErrorMessage('Database', 'mysqlConnectError'));
		}
		
		sybase_select_db($this->config['database'], $this->connect);
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
			$info      = sybase_fetch_field($this->query, $i);
			$fieldName = $info->name;
			
			$columns[$fieldName]				= new \stdClass();
			$columns[$fieldName]->name			= $fieldName;
			$columns[$fieldName]->type			= $info->type;
			$columns[$fieldName]->maxLength		= $info->max_length;
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
	* NUM ROWS                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için toplam kayıt sayısı bilgisini verir.                	  | 
	|          																				  |
	******************************************************************************************/
	public function numRows()
	{
		if( ! empty($this->query) )
		{
			return sybase_num_rows($this->query);
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
			$columns[] = sybase_fetch_field($this->query, $i);
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
			return sybase_num_fields($this->query);
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
			return sybase_get_last_message();
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
			return sybase_fetch_array($this->query);
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
			return sybase_fetch_assoc($this->query);
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
			return sybase_fetch_row($this->query);
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
			return sybase_affected_rows($this->connect);
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
			@sybase_close($this->connect);
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
			return false;
		}
	}
}