<?php
namespace ZN\Database\Drivers;

class MySQLDriver implements DatabaseDriverInterface
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
	
	use MySQL\Traits\QueryTrait;
	use MySQL\Traits\ForgeTrait;
	use MySQL\Traits\ToolTrait;
	use MySQL\Traits\UserTrait;
	
	use Traits\DatabaseDriverTrait;
	
	public function __construct()
	{
		if( ! function_exists('mysql_connect') )
		{
			die(getErrorMessage('Error', 'undefinedFunctionExtension', 'Mysql'));	
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
		$this->config  = $config;
		$this->connect = ( $this->config['pconnect'] === true)
						 ? @mysql_pconnect($this->config['host'], $this->config['user'], $this->config['password'])
						 : @mysql_connect($this->config['host'], $this->config['user'], $this->config['password']);
							
		if( empty($this->connect) ) 
		{
			die(getErrorMessage('Database', 'mysqlConnectError'));
		}
		
		mysql_select_db($this->config['database'], $this->connect);
			
		if( ! empty($this->config['charset']) )
		{   
			$this->query("SET NAMES '".$this->config['charset']."'", $this->connect);
		}
		if( ! empty($this->config['charset']) )
		{   
			$this->query('SET CHARACTER SET '.$this->config['charset'], $this->connect);	
		}
		if( ! empty($this->config['collation']) )
		{ 
			$this->query('SET COLLATION_CONNECTION = "'.$this->config['collation'].'"', $this->connect);
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
			return mysql_insert_id($this->connect);
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
			$fieldName = mysql_field_name($this->query, $i);
			
			$columns[$fieldName]				= new \stdClass();
			$columns[$fieldName]->name			= $fieldName;
			$columns[$fieldName]->type			= mysql_field_type($this->query, $i);
			$columns[$fieldName]->maxLength		= mysql_field_len($this->query, $i);
			$columns[$fieldName]->primaryKey	= (int) (stripos(mysql_field_flags($this->query, $i), 'primary_key') !== false);
			$columns[$fieldName]->default		= '';
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
			return mysql_num_rows($this->query);	
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
				$columns[] = mysql_field_name($this->query,$i);
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
			return mysql_num_fields($this->query);
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
		
		return mysql_real_escape_string($data, $this->connect);
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
			return mysql_error($this->connect);
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
			return mysql_fetch_array($this->query);
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
			return mysql_fetch_assoc($this->query);
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
			return mysql_fetch_row($this->query);
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
			return mysql_affected_rows($this->connect);
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
			@mysql_close($this->connect); 
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
			return mysql_get_server_info($this->connect);
		}
	}	
}